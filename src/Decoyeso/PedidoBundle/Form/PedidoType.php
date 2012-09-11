<?php

namespace Decoyeso\PedidoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('cliente','entity', array('class'=>'Decoyeso\\ClientesBundle\\Entity\\Cliente','label'=>'Cliente','empty_value'=>"Seleccione cliente",'multiple'=>false, 'expanded'=>false))
        	->add('obra', 'text', array('label'=>'Obra'))
        	->add('requiereRelevamiento','choice',array('choices' =>array(0=>"No",1=>"Si"),"label"=>"Requiere relevamiento"))
        	->add('prioridad','choice',array('choices' =>array(1=>"Baja",2=>"Media",3=>"Alta",4=>"Muy alta"),"label"=>"Prioridad"))
        	->add('fechaSolicitado','date', array("format"=>"d-m-Y",'pattern'=> '{{ day }}{{ month }}{{ year }}','label'=>'Fecha de solicitación'))
        	->add('fechaEntrega','date', array("format"=>"d-m-Y",'pattern'=> '{{ day }}{{ month }}{{ year }}','label'=>'Fecha de entrega'))
            ->add('descripcion','textarea',array('label'=>'Descripcion', 'required'=> false, 'attr'=> array('class'=>'no_editor_textarea')))
            
        ;
    } 

    public function getName()
    {
        return 'pedido';
    }
}
