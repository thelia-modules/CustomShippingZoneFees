<?php

namespace CustomShippingZoneFees\Controller;

use CustomShippingZoneFees\Form\ShippingZoneEditModuleForm;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use Symfony\Component\HttpFoundation\Request;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Tools\URL;

class DeliveryModuleController extends BaseAdminController
{
    public function updateDeliveryModuleShippingZoneAction(Request $request)
    {
        $moduleId = $request->get('moduleId');
        $shippingZoneEdit = $this->createForm(ShippingZoneEditModuleForm::getName());
        try{
            $form = $this->validateForm($shippingZoneEdit);

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
    public function removeDeliveryModuleShippingZoneAction(Request $request)
    {
        $CustomShippingZoneFeesModules = CustomShippingZoneFeesModulesQuery::create()->findOneById($request->get('id'));

        $moduleId = $CustomShippingZoneFeesModules->getModuleId();

        $CustomShippingZoneFeesModules->delete();

        return $this->generateRedirect(URL::getInstance()->absoluteUrl("admin/configuration/shipping_zones/update/$moduleId"));

    }
}