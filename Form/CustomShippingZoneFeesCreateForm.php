<?php

namespace CustomShippingZoneFees\Form;


use CustomShippingZoneFees\CustomShippingZoneFees;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\Country;
use Thelia\Model\CountryQuery;

class CustomShippingZoneFeesCreateForm extends BaseForm
{
    protected function buildForm()
    {
        $countries = CountryQuery::create()->find();
        $choice = [];
        $local = $this->getRequest()->getSession()->getAdminLang();

        /** @var Country $country */
        foreach ($countries as $country){
            $choice[] = [
                $country->setLocale($local->getLocale())->getTitle() => $country->getId()
            ];
        }

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
            ])
            ->add('fee', NumberType::class, [
                'required' => false,
                'label'=> Translator::getInstance()->trans(
                    'Fee',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'fee'
                )
            ])
            ->add('country', ChoiceType::class,[
                'required' => true,
                'label'=> Translator::getInstance()->trans(
                    'Country',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'country'
                ),
                'choices' => $choice
            ])
            ->add('zipcodes', TextareaType::class, [
                'required' => false,
                'label'=> Translator::getInstance()->trans(
                    'Zip codes separated by a comma',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'zipcodes'
                )
            ])
        ;
    }

    public static function getName()
    {
        return 'custom_shipping_zone_fees_create_form';
    }
}