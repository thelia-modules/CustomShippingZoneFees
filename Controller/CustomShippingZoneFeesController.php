<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 21/08/2020
 * Time: 15:59
 */

namespace CustomShippingZoneFees\Controller;


use CustomShippingZoneFees\Form\CustomShippingZoneFeesCreateForm;
use CustomShippingZoneFees\Form\ZipCodeCreateForm;
use CustomShippingZoneFees\Model\CustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZip;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesZipQuery;
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
        try{
            $form = $this->validateForm(new CustomShippingZoneFeesCreateForm($this->getRequest()));

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

    public function deleteShippingZoneAction()
    {
        $id = $this->getRequest()->get('id');

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

    public function updateShippingZoneAction()
    {
        $id = $this->getRequest()->get("id");
        $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);
        /** @var Lang $lang */
        $lang = $this->getSession()->get("thelia.admin.edition.lang");
        try{
            $form = $this->validateForm(new CustomShippingZoneFeesCreateForm($this->getRequest()));

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

    public function createZipShippingZoneAction()
    {
        $lang = $this->getSession()->get("thelia.admin.edition.lang");
        $id = $this->getRequest()->get("id");
        try{
            $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);
            $form = $this->validateForm(new ZipCodeCreateForm($this->getRequest()));
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

    public function deleteZipShippingZoneAction()
    {
        $lang = $this->getSession()->get("thelia.admin.edition.lang");
        $zip = CustomShippingZoneFeesZipQuery::create()->findOneById($this->getRequest()->get("zipId"));
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
    public function renderShippingZonePageAction()
    {
        $defaultLang = LangQuery::create()->findOneByByDefault(1);
        $locale = $defaultLang->getLocale();
        if ($langId = $this->getRequest()->get('edit_language_id')){
            $locale = LangQuery::create()->findOneById($langId)->getLocale();
        }
        $id = $this->getRequest()->get('id');
        $shippingZone = CustomShippingZoneFeesQuery::create()->findOneById($id);

        $zipCodes = $shippingZone->getCustomShippingZoneFeesZips();

        $defaultCurrency = CurrencyQuery::create()->filterByByDefault(1)->findOne();
        $currencies = CurrencyQuery::create()->filterByVisible(1)->filterByByDefault(0)->find()->toArray();

        return $this->render('CustomShippingZoneFeesEdit', [
            'shippingZoneId' => $shippingZone->getId(),
            'edit_language_id' => $langId ? : $defaultLang->getId(),
            'defaultCurrency' => $defaultCurrency,
            'currencies' => $currencies,
            "err" => $this->getRequest()->get('err')
        ], 200);
    }
}

