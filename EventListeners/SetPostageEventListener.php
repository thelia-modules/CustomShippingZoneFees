<?php

namespace CustomShippingZoneFees\EventListeners;


use CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use OpenApi\Events\DeliveryModuleOptionEvent;
use OpenApi\Events\OpenApiEvents;
use OpenApi\Model\Api\DeliveryModuleOption;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Core\Event\Delivery\DeliveryPostageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;


class SetPostageEventListener implements EventSubscriberInterface
{
    protected $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
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
                    $postage = $event->getPostage();
                    $postage->setAmount($postage->getAmount() + ($zoneModule->getCustomShippingZoneFees()->getFee() * $rate));
                    break;
                }
            }
        }

        return $event;
    }

    public function setModuleDeliveryPostageOpenApi(DeliveryModuleOptionEvent $event)
    {
        $deliveryModule = $event->getModule();

        if(!$address = $event->getAddress()){
            return $event;
        }

        $rate = $this->getRequest()->getSession()->getCurrency()->getRate();

        if (!$shippingZoneModule = CustomShippingZoneFeesModulesQuery::create()->filterByModuleId($deliveryModule->getId())->find()->getData()){
            return $event;
        }

        /** @var CustomShippingZoneFeesModules $zoneModule */
        foreach ($shippingZoneModule as $zoneModule){
            $zipCodes = $zoneModule->getCustomShippingZoneFees()->getCustomShippingZoneFeesZips();

            foreach ($zipCodes as $zipCode){
                if ($zipCode->getZipCode() === $address->getZipcode() && $zipCode->getCountryId() === $address->getCountryId()){
                    /** @var DeliveryModuleOption $deliveryModuleOption */
                    foreach ($event->getDeliveryModuleOptions() as $deliveryModuleOption){
                        $deliveryModuleOption->setPostage($deliveryModuleOption->getPostage() > 0 ? $deliveryModuleOption->getPostage() + ($zoneModule->getCustomShippingZoneFees()->getFee() * $rate) : 0);
                        $deliveryModuleOption->setPostageUntaxed($deliveryModuleOption->getPostageUntaxed() > 0 ? $deliveryModuleOption->getPostageUntaxed() + ($zoneModule->getCustomShippingZoneFees()->getFee() * $rate) : 0);
                    }
                    break;
                }
            }
        }

        return $event;
    }

    public static function getSubscribedEvents()
    {
        return array(
            TheliaEvents::MODULE_DELIVERY_GET_POSTAGE =>['setModuleDeliveryPostage', 127],
            OpenApiEvents::MODULE_DELIVERY_GET_OPTIONS =>['setModuleDeliveryPostageOpenApi', 100]
        );
    }

}