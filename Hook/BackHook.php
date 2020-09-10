<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 21/08/2020
 * Time: 11:15
 */

namespace CustomShippingZoneFees\Hook;


use CustomShippingZoneFees\Model\Base\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\CurrencyQuery;
use Thelia\Tools\MoneyFormat;

class BackHook extends BaseHook
{
    public function onModuleConfiguration(HookRenderEvent $event)
    {
        $currency = CurrencyQuery::create()->filterByByDefault(1)->findOne();

        $event->add($this->render('CustomShippingZoneFeesConfig.html',[
            'SYMBOL' => $currency->getSymbol()
        ]));
    }

    /**
     * @param HookRenderEvent $event
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function onShippingZonesEditBottom(HookRenderEvent $event)
    {
        $lang = $this->getSession()->getLang()->getLocale();
        $moduleId = $event->getArgument('delivery_module_id');
        $shippingZoneModule = CustomShippingZoneFeesModulesQuery::create()->filterByModuleId($moduleId);
        $result = null;

        /** @var CustomShippingZoneFeesModules $szm */
        foreach ($shippingZoneModule as $szm){
            $shippingZone = $szm->getCustomShippingZoneFees();
            $result[] = [
                'id' => $shippingZone->getId(),
                'name' => $shippingZone->setLocale($lang)->getName(),
                'fee' => MoneyFormat::getInstance($this->getRequest())->formatByCurrency($shippingZone->getFee()),
                'shippingToModuleId' => $szm->getId()
            ];
        }

        $event->add($this->render('hook/ShippingZoneEditBottom.html', [
            'shipping_zones' => $result
        ]));

    }
}