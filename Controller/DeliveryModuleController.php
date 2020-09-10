<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 27/08/2020
 * Time: 11:54
 */

namespace CustomShippingZoneFees\Controller;

use CustomShippingZoneFees\Form\ShippingZoneEditModuleForm;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Tools\URL;

class DeliveryModuleController extends BaseAdminController
{
    public function updateDeliveryModuleShippingZoneAction()
    {
        $moduleId = $this->getRequest()->get('moduleId');
        try{
            $form = $this->validateForm(new ShippingZoneEditModuleForm($this->getRequest()));

            (new CustomShippingZoneFeesModules())
                ->setCustomShippingZoneFeesId($form->get('select_zone')->getData())
                ->setModuleId($moduleId)
                ->save();
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("admin/configuration/shipping_zones/update/$moduleId"));
        }catch(\Exception $e){
            return $this->generateRedirect(URL::getInstance()->absoluteUrl("admin/configuration/shipping_zones/update/$moduleId"));
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function removeDeliveryModuleShippingZoneAction()
    {
        $CustomShippingZoneFeesModules = CustomShippingZoneFeesModulesQuery::create()->findOneById($this->getRequest()->get('id'));

        $moduleId = $CustomShippingZoneFeesModules->getModuleId();

        $CustomShippingZoneFeesModules->delete();

        return $this->generateRedirect(URL::getInstance()->absoluteUrl("admin/configuration/shipping_zones/update/$moduleId"));

    }
}