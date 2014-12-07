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
            ->add('body', 'textarea', ['label' => 'Comment'])
            ->add('mail', 'email', ['label' => 'Email'])
            ->add('save', 'submit', ['label' => 'Add a comment']);
    }

    public function getName()
    {
        return 'comment';
    }
} 