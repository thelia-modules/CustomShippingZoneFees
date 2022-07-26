<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 28/08/2020
 * Time: 14:11
 */

namespace CustomShippingZoneFees\EventListeners;


use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneExcludedZipQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Delivery\DeliveryPostageEvent;
use Thelia\Core\Event\TheliaEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use OpenApi\Events\DeliveryModuleOptionEvent;
use OpenApi\Events\ModelExtendDataEvent;
use OpenApi\Events\OpenApiEvents;
use OpenApi\Model\Api\DeliveryModule;
use OpenApi\Model\Api\Cart;
use OpenApi\OpenApi;


class SetPostageEventListener implements EventSubscriberInterface
{
    protected $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack;
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

    public function modifyModuleDeliveryOptions(DeliveryModuleOptionEvent $event)
    {
        $address = $event->getAddress();
        $options = $event->getDeliveryModuleOptions();

        $zipCodesExcluded = CustomShippingZoneExcludedZipQuery::create()->filterByCountryId($address->getCountryId())->find()->getData();
        foreach ($zipCodesExcluded as $zipCodeExcluded){
            if (strpos($address->getZipcode(), $zipCodeExcluded->getZipCode()) === 0) {
                foreach ($options as $option) {
                    $option->setValid(false);
                }
            }
        }
    }


    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::MODULE_DELIVERY_GET_POSTAGE => ['setModuleDeliveryPostage', 10],
            OpenApiEvents::MODULE_DELIVERY_GET_OPTIONS => ['modifyModuleDeliveryOptions', 20],
        ];
    }

}