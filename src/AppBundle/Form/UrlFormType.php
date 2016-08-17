<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;

class UrlFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('title')
            -> add('domain')
            -> add('url')
            -> add('status',HiddenType::class)
            -> add('statusDesc',null, array('attr'=> array('readonly'=>'readonly'), 'mapped' => false))
            -> add('description')
            -> add('test',ButtonType::class,array('attr'=> array('onclick'=>'checkUrl()','class'=>'btn btn-success pull-left', 'style'=>'margin-right:10px')))
            -> add('save',SubmitType::class,array('attr'=> array('class'=>'btn btn-primary pull-left')))
        ;
    }
}