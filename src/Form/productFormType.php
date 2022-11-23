<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class productFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Amount', ChoiceType::class, [
            'choices' => [
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
            ],

        ]);
        $builder->add('pizza_size', ChoiceType::class, [
            'choices' => [
                'meduim pizza(25 cm)' => 1,
                'large pizza(35 cm)' => 2,
                'calzone' => 3,
            ],
        ]);
    }
}