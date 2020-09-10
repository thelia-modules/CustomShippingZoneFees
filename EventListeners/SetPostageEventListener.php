<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 28/08/2020
 * Time: 14:11
 */

namespace CustomShippingZoneFees\EventListeners;


use CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Delivery\DeliveryPostageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;


class SetPostageEventListener implements EventSubscriberInterface
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param DeliveryPostageEvent $event
     * @return DeliveryPostageEvent
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setModuleDeliveryPostage(DeliveryPostageEvent $event)
    {
        $deliveryModule = $event->getModule();

        if(!$address = $event->getAddress()){
            return $event;
        }

        $rate = $this->getRequest()->getSession()->getCurrency()->getRate();

        if (!$shippingZoneModule = CustomShippingZoneFeesModulesQuery::create()->filterByModuleId($deliveryModule->getModuleModel()->getId())->find()->getData()){
            return $event;
        }

        /** @var CustomShippingZoneFeesModules $zoneModule */
        foreach ($shippingZoneModule as $zoneModule){
            $zipCodes = $zoneModule->getCustomShippingZoneFees()->getCustomShippingZoneFeesZips();

            foreach ($zipCodes as $zipCode){
                if ($zipCode->getZipCode() === $address->getZipcode() && $zipCode->getCountryId() === $address->getCountryId()){
                    $event->setPostage($event->getPostage()->getAmount() + ($zoneModule->getCustomShippingZoneFees()->getFee() * $rate));
                    break;
                }
            }
        }

        return $event;
    }


    public static function getSubscribedEvents()
    {
        return array(
            TheliaEvents::MODULE_DELIVERY_GET_POSTAGE => array('setModuleDeliveryPostage')
        );
    }

}