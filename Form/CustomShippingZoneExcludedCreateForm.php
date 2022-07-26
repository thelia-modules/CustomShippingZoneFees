<?php
/**
 * Created by PhpStorm.
 * User: nicolasbarbey
 * Date: 21/08/2020
 * Time: 15:03
 */

namespace CustomShippingZoneFees\Form;


use CustomShippingZoneFees\CustomShippingZoneFees;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class CustomShippingZoneExcludedCreateForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add('name', TextType::class, [
                'required' => true,
                'label'=> Translator::getInstance()->trans(
                    'Shipping zone name',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'name'
                )
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label'=> Translator::getInstance()->trans(
                    'Description',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'description'
                )
            ]);
    }

    public static function getName()
    {
        return 'custom_shipping_zone_excluded_create_form';
    }
}