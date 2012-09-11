<?php

namespace Decoyeso\PedidoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RelevamientoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
       		->add('pedido','entity', array('class'=>'Decoyeso\\PedidoBundle\\Entity\\Pedido','empty_value'=>'Seleccione pedido','label'=>'Pedido','multiple'=>false, 'expanded'=>false))
        	->add('barrio', 'text', array('label'=>'Barrio', 'required'=>false))
        	->add('calle', 'text', array('label'=>'Calle', 'required'=>false))
        	->add('numeroCalle','text', array('label'=>"Número", 'required'=>false))
        	
        	
            ->add('descripcion','textarea',array('label'=>'Descripción','attr'=> array('class'=>'no_editor_textarea')))
            
        ;
    } 

    public function getName()
    {
        return 'relevamiento';
    }
}
