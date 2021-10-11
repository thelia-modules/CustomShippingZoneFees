<?php

namespace CustomShippingZoneFees\Controller;


use CustomShippingZoneFees\Form\CustomShippingZoneFeesCreateForm;
use CustomShippingZoneFees\Form\ZipCodeCreateForm;
use CustomShippingZoneFees\Model\CustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZip;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery;
use Symfony\Component\HttpFoundation\Request;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Model\Base\CurrencyQuery;
use Thelia\Model\Lang;
use Thelia\Model\LangQuery;
use Thelia\Tools\URL;

class CustomShippingZoneFeesController extends BaseAdminController
{
    public function createShippingZoneAction()
    {
        $langs = LangQuery::create()->filterByActive(1)->find();

        $shippingZoneFeeForm = $this->createForm(CustomShippingZoneFeesCreateForm::getName());
        try{
            $form = $this->validateForm($shippingZoneFeeForm);

            $shippingZone = new CustomShippingZoneFees();

            foreach ($langs as $lang){
                $shippingZone
                    ->setFee($form->get('fee')->getData())
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

    public function deleteShippingZoneAction(Request $request)
    {
        $id = $request->get('id');

        try{
            $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);
            foreach ($shippingZone->getCustomShippingZoneFeesZips() as $zip){
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

    public function updateShippingZoneAction(Request $request)
    {
        $id = $request->get("id");
        $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);
        /** @var Lang $lang */
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $shippingZoneFeeForm = $this->createForm(CustomShippingZoneFeesCreateForm::getName());
        try{
            $form = $this->validateForm($shippingZoneFeeForm);

            $shippingZone
                ->setFee($form->get('fee')->getData())
                ->setLocale($lang->getLocale())
                ->setName($form->get('name')->getData())
                ->setDescription($form->get('description')->getData())
                ->save();

            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id", [
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    public function createZipShippingZoneAction(Request $request)
    {
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $id = $request->get("id");
        $zipCodeForm = $this->createForm(ZipCodeCreateForm::getName());
        try{
            $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);
            $form = $this->validateForm($zipCodeForm);
            $zip = (new CustomShippingZoneFeesZip())
                ->setZipCode($form->get("zip")->getData())
                ->setCountryId($form->get("country")->getData());
            $shippingZone->addCustomShippingZoneFeesZip($zip)->save();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id",[
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    public function deleteZipShippingZoneAction(Request $request)
    {
        $lang = $request->getSession()->get("thelia.admin.edition.lang");
        $zip = CustomShippingZoneFeesZipQuery::create()->findOneById($request->get("zipId"));
        $id = $zip->getCustomShippingZoneFeesId();
        try{
            $zip->delete();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id",[
                "edit_language_id" => $lang->getId()
            ]));
        }catch (\Exception $exception) {
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("/admin/module/CustomShippingZoneFees/edit/$id", [
                "err" => $exception->getMessage(),
                "edit_language_id" => $lang->getId()
            ]));
        }
    }

    /**
     * @return \Thelia\Core\HttpFoundation\Response
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function renderShippingZonePageAction(Request $request)
    {
        if (!$langId = $request->get('edit_language_id')){
            $langId = LangQuery::create()->filterByByDefault(1)->findOne();
        }
        $id = $request->get('id');
        $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);

        $defaultCurrency = CurrencyQuery::create()->filterByByDefault(1)->findOne();
        $currencies = CurrencyQuery::create()->filterByVisible(1)->filterByByDefault(0)->find()->toArray();

        return $this->render('CustomShippingZoneFeesEdit', [
            'shippingZoneId' => $shippingZone->getId(),
            'edit_language_id' => $langId,
            'defaultCurrency' => $defaultCurrency,
            'currencies' => $currencies,
            "err" => $request->get('err')
        ], 200);
    }
}

