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
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeliveryModuleController
 * @Route("/admin/module/CustomShippingZoneFees", name="module_delivery") 
 */
class DeliveryModuleController extends BaseAdminController
{
    
    /**
     * @Route("/updateModule/{moduleId}", name="update_module_delivery") 
     */
    public function updateDeliveryModuleShippingZoneAction($moduleId)
    {
        try{
            $form = $this->validateForm($this->createForm(ShippingZoneEditModuleForm::getName()));

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
     * @Route("/remove/{id}", name="remove_module_delivery")
     */
    public function removeDeliveryModuleShippingZoneAction($id)
    {
        $CustomShippingZoneFeesModules = CustomShippingZoneFeesModulesQuery::create()->findOneById($id);

        $moduleId = $CustomShippingZoneFeesModules->getModuleId();

        $CustomShippingZoneFeesModules->delete();

        return $this->generateRedirect(URL::getInstance()->absoluteUrl("admin/configuration/shipping_zones/update/$moduleId"));

    }
}