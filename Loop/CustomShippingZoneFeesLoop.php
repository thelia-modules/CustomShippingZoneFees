<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 27/08/2020
 * Time: 16:13
 */

namespace CustomShippingZoneFees\Loop;


use CustomShippingZoneFees\Model\CustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModules;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesModulesQuery;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

class CustomShippingZoneFeesLoop extends BaseLoop implements PropelSearchLoopInterface
{

    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntListTypeArgument('id'),
            Argument::createIntListTypeArgument('module_id'),
            Argument::createIntListTypeArgument('without_zone'),
            Argument::createAlphaNumStringTypeArgument('locale')
        );
    }

    public function buildModelCriteria()
    {
        $query = CustomShippingZoneFeesQuery::create();

        if ($ids = $this->getId()){
            $query->filterById($ids);
        }

        if ($moduleId = $this->getmoduleId()){
            $query
                ->useCustomShippingZoneFeesModulesQuery()
                ->filterByModuleId($moduleId)
                ->endUse();
        }

        if ($withoutZone = $this->getWithoutZone()){
            $moduleShippingZone = CustomShippingZoneFeesModulesQuery::create()->filterByModuleId($withoutZone)->find();
            $ids = null;
            /** @var CustomShippingZoneFeesModules $m */
            foreach ($moduleShippingZone as $m){
                $ids[] = $m->getCustomShippingZoneFeesId();
            }
            $query->filterById( $ids,Criteria::NOT_IN);
        }

        return $query;
    }

    /**
     * @param LoopResult $loopResult
     * @return LoopResult
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function parseResults(LoopResult $loopResult)
    {
        $locale = $this->getLocale();
        /** @var CustomShippingZoneFees $shippingZone */
        foreach ($loopResult->getResultDataCollection() as $shippingZone) {
            $loopResultRow = new LoopResultRow($shippingZone);
            $loopResultRow
                ->set("ID", $shippingZone->getId())
                ->set("FEE", $shippingZone->getFee())
                ->set("NAME", $shippingZone->setLocale($locale)->getName())
                ->set("DESCRIPTION", $shippingZone->setLocale($locale)->getDescription())
                ->set("ZIP_CODES", $shippingZone->getCustomShippingZoneFeesZips())
            ;
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}