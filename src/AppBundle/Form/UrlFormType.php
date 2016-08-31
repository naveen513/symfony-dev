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
            -> add('title',null, array('attr'=> array('data-help'  => 'Title: Name of the test case. Ex: Test Case Scenario 1')))
            -> add('url',null, array('attr'=> array('data-help'  => 'Url: Link that needs to be tested. Ex: http://symfony.com/what-is-symfony')))
            -> add('status',HiddenType::class)
            -> add('statusDesc',null, array('label'=> 'Status', 'attr'=> array('readonly'=>'readonly','data-help'  => 'Status: Will be filled automatically when Test button is clicked'), 'mapped' => false))
            -> add('description')
            -> add('test',ButtonType::class,array('attr'=> array('onclick'=>'checkUrl()','class'=>'btn btn-success pull-left', 'style'=>'margin-right:10px')))
            -> add('save',SubmitType::class,array('attr'=> array('class'=>'btn btn-primary pull-left')))
        ;
    }
}