<?php

namespace Decoyeso\ClientesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('tipo', 'choice', array('choices'=>
        		array(1 => 'Persona Física', 2 => 'Organización')
        	))
        	->add('nombre', 'text', array('label'=> 'Apellido, Nombre'))
        	->add('dni', 'text', array('label'=> 'DNI', 'required'=>false))
        	->add('cuitOcuil', 'text', array('label'=> 'CUIL', 'required'=>false))   
            ->add('telefono', 'text', array('label'=> 'Teléfono', 'required'=>false))
            ->add('celular', 'text', array('label'=> 'Celular', 'required'=>false))
            ->add('email', 'email', array('label'=> 'Email', 'required'=>false))
            ->add('barrio', 'text', array('label'=> 'Dirección, Barrio', 'required'=>false))
            ->add('calle', 'text', array('label'=> 'Dirección, Calle', 'required'=>false))
            ->add('numeroCalle', 'text', array('label'=> 'Dirección, Número', 'required'=>false))

            ->add('observaciones','textarea', array('label'=>'Observaciones', 'required'=>false, 'attr'=> array('class'=>'no_editor_textarea')))

        ;
    }

    public function getName()
    {
        return 'cliente';
    }
}
