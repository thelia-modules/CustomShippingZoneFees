<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 21/08/2020
 * Time: 15:59
 */

namespace CustomShippingZoneFees\Controller;


use CustomShippingZoneFees\Form\CustomShippingZoneExcludedCreateForm;
use CustomShippingZoneFees\Form\ZipCodeCreateForm;
use CustomShippingZoneFees\Model\CustomShippingZoneExcluded;
use CustomShippingZoneFees\Model\CustomShippingZoneExcludedQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneExcludedZip;
use CustomShippingZoneFees\Model\CustomShippingZoneExcludedZipQuery;
use Symfony\Component\HttpFoundation\Request;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Model\Base\CurrencyQuery;
use Thelia\Model\Lang;
use Thelia\Model\LangQuery;
use Thelia\Tools\URL;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomShippingZoneExcludedController
 * @Route("/admin/module/CustomShippingZoneFees", name="custom_shipping_zone_excluded") 
 */
class CustomShippingZoneExcludedController extends BaseAdminController
{
    /**
     * @Route("/create-excluded", name="create_excluded") 
     */
    public function createShippingZoneAction()
    {
        $langs = LangQuery::create()->filterByActive(1)->find();

        $createForm = $this->createForm(CustomShippingZoneExcludedCreateForm::getName());
        try{
            $form = $this->validateForm($createForm);

            $shippingZone = new CustomShippingZoneExcluded();

            foreach ($langs as $lang){
                $shippingZone
                    ->setLocale($lang->getLocale())
                    ->setName($form->get('name')->getData())
                    ->setDescription($form->get('description')->getData());
            }
            $shippingZone->save();

            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees"));

        }catch (\Exception $exception){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees",[
                "err" => $exception->getMessage()
            ]));
        }
    }
    /**
     * @Route("/delete-excluded/{id}", name="delete_excluded") 
     */
    public function deleteShippingZoneExcludedAction($id)
    {
        try{
            $shippingZone = CustomShippingZoneExcludedQuery::create()->findOneById($id);
            foreach ($shippingZone->getCustomShippingZoneExcludedZips() as $zip){
                $zip->delete();
            }
            $shippingZone->delete();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees"));
        }catch (\Exception $exception) {
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees", [
                "err" => $exception->getMessage()
            ]));
        }
    }

    /**
     * @Route("/update-excluded/{id}", name="update_excluded") 
     */
    public function updateShippingZoneAction($id, Request $request)
    {
        $shippingZone = CustomShippingZoneExcludedQuery::create()->findOneById($id);
        /** @var Lang $lang */
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $createForm = $this->createForm(CustomShippingZoneExcludedCreateForm::getName());
        try{
            $form = $this->validateForm($createForm);

            $shippingZone
                ->setFee($form->get('fee')->getData())
                ->setLocale($lang->getLocale())
                ->setName($form->get('name')->getData())
                ->setDescription($form->get('description')->getData())
                ->save();

            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$id", [
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$id", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    /**
     * @Route("/zip/create-excluded/{id}", name="zip_create_excluded") 
     */
    public function createZipShippingZoneAction($id, Request $request)
    {
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $createForm = $this->createForm(ZipCodeCreateForm::getName());
        try{
            $shippingZone = CustomShippingZoneExcludedQuery::create()->findOneById($id);
            $form = $this->validateForm($createForm);
            $zip = (new CustomShippingZoneExcludedZip())
                ->setZipCode($form->get("zip")->getData())
                ->setCountryId($form->get("country")->getData());
            $shippingZone->addCustomShippingZoneExcludedZip($zip)->save();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$id",[
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$id", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    /**
     * @Route("/zip/delete-excluded/{id}", name="zip_delete_excluded") 
     */
    public function deleteZipShippingZoneAction($id, Request $request)
    {
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $zip = CustomShippingZoneExcludedZipQuery::create()->findOneById($id);
        $customShippingZoneFeesId = $zip->getCustomShippingZoneExcludedId();
        try{
            $zip->delete();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$customShippingZoneFeesId",[
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception) {
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit-excluded/$customShippingZoneFeesId", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    /**
     * @return \Thelia\Core\HttpFoundation\Response
     * @throws \Propel\Runtime\Exception\PropelException
     * @Route("/edit-excluded/{id}", name="edit_excluded") 
     */
    public function renderShippingZonePageAction($id, Request $request)
    {
        $defaultLang = LangQuery::create()->findOneByByDefault(1);
        $locale = $defaultLang->getLocale();
        if ($langId = $request->get('edit_language_id')){
            $locale = LangQuery::create()->findOneById($langId)->getLocale();
        }
        $shippingZone = CustomShippingZoneExcludedQuery::create()->findOneById($id);

        $zipCodes = $shippingZone->getCustomShippingZoneExcludedZips();

        $defaultCurrency = CurrencyQuery::create()->filterByByDefault(1)->findOne();
        $currencies = CurrencyQuery::create()->filterByVisible(1)->filterByByDefault(0)->find()->toArray();

        return $this->render('CustomShippingZoneExcludedEdit', [
            'shippingZoneId' => $shippingZone->getId(),
            'edit_language_id' => $langId ? : $defaultLang->getId(),
            'defaultCurrency' => $defaultCurrency,
            'currencies' => $currencies,
            "err" => $request->get('err')
        ], 200);
    }
}

