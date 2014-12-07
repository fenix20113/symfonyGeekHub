<?php

namespace Geekhub\GeekBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ArticleType
 * @package Geekhub\GeekBundle\Form\Type
 */
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', ['label' => 'Title'])
            ->add('text', 'textarea', ['label' => 'Text'])
            ->add('save', 'submit', ['label' => 'Save']);
    }

    public function getName()
    {
        return 'article';
    }
} 