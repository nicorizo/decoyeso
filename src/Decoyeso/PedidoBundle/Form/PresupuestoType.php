<?php

namespace Decoyeso\PedidoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PresupuestoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('pedido','entity',array('class'=>'Decoyeso\\PedidoBundle\\Entity\\Pedido','label'=>'Pedido','multiple'=>false, 'expanded'=>false))
            
            ->add('mostrarColumnas','choice',
            		
            		array(
            				
            				'choices' =>array(
            						0=> "UNIDAD",
            						1=> "CANTIDAD",
            						2=> "PRECIO UNIT.",
            						3=> "PRECIO VTA S/IVA",
            						4=> "PRECIO VTA C/IVA",
            						5=> "PRECIO TOTAL"            						
            						),
            				
            				'multiple'=> "true",
            				"expanded"=> "true",
            				"label"=>"Precios Unitarios"))
         
            ->add('subTotal', 'text', array('label'=>"",'attr'=> array('class'=>'inputCorto')))
            ->add('total', 'text', array('label'=>"",'attr'=> array('class'=>'inputCorto')))
            
            ->add('precioEntrega', 'text', array('label'=>"", 'required'=> false,'attr'=> array('class'=>'input190'), 'required'=>false))
            
            ->add('precioTextoEntrega', 'text', array('label'=>"",'required'=> false,'attr'=> array('class'=>'input190'), 'required'=>false))
            ->add('precioSaldo', 'text', array('label'=>"",'required'=> false,'attr'=> array('class'=>'input190'), 'required'=>false))
            ->add('formaPago', 'text', array('label'=>"",'required'=> false,'attr'=> array('class'=>''), 'required'=>false))
            
            
            
            
        ;
    }

    public function getName()
    {
        return 'decoyeso_pedidobundle_presupuestotype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Decoyeso\\PedidoBundle\\Entity\\Presupuesto',
    			'intention'  => 'presupuesto',
    			'csrf_protection' => true,
    			'csrf_field_name' => '_token',
    			// una clave única para ayudar a generar el elemento secreto
    			'intention'	=> 'presupuesto_item',
    			
    			
    	);
    }
    
    
}
