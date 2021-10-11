<?php

namespace CustomShippingZoneFees\Form;


use CustomShippingZoneFees\CustomShippingZoneFees;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use Thelia\Model\Country;
use Thelia\Model\CountryQuery;

class ZipCodeCreateForm extends BaseForm
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
            ->add('zip', TextType::class,[
                'required' => true,
                'label'=> Translator::getInstance()->trans(
                    'Zip code',
                    array(),
                    CustomShippingZoneFees::DOMAIN_NAME
                ),
                'label_attr' => array(
                    'for' => 'zip'
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
            ]);
    }

    public static function getName()
    {
        return "zip_code_create_form";
    }
}