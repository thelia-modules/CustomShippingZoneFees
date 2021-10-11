<?php

namespace CustomShippingZoneFees\Form;


use CustomShippingZoneFees\CustomShippingZoneFees;
use CustomShippingZoneFees\Model\CustomShippingZoneFees as CustomShippingZoneFeesModel;
use CustomShippingZoneFees\Model\CustomShippingZoneFeesQuery;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class ShippingZoneEditModuleForm extends BaseForm
{
    protected function buildForm()
    {
        $locale = $this->getRequest()->getSession()->getLang()->getLocale();
        $shippingZones = CustomShippingZoneFeesQuery::create()->find();
        $choices = null;
        /** @var CustomShippingZoneFeesModel $shippingZone */
        foreach ($shippingZones as $shippingZone){
            $choices[$shippingZone->setLocale($locale)->getName()] = $shippingZone->getId();
        }

        $this->formBuilder
            ->add('select_zone', ChoiceType::class, [
                'required' => true,
                'label'=> Translator::getInstance()->trans(
                    'Custom shipping zones',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'select_zone'
                ),
                'choices' => $choices
            ]);
    }

    public static function getName()
    {
        return 'shipping_zone_edit_module_form';
    }
}