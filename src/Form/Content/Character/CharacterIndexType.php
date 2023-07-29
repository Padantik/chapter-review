<?php

declare(strict_types=1);

namespace App\Form\Content\Character;

use App\Form\IndexType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CharacterIndexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class);
    }

    public function getParent(): string
    {
        return IndexType::class;
    }

}