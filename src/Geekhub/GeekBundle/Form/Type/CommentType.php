<?php

namespace Geekhub\GeekBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CommentType
 * @package Geekhub\GeekBundle\Form\Type
 */
class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', 'textarea', ['label' => 'comment.text'])
            ->add('mail', 'email', ['label' => 'comment.email'])
            ->add('save', 'submit', ['label' => 'comment.actions.add']);
    }

    public function getName()
    {
        return 'comment';
    }
} 