<?php

namespace App\Form;

use App\Entity\Food;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('imageFile',FileType::class, ['required' => false])
            ->add('calories')
            ->add('protein')
            ->add('carbohydrates')
            ->add('fats')
            ->add('type', EntityType::class,[
                'class' => Type::class,
                'choice_label' => 'fieldName',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Food::class,
        ]);
    }
}
