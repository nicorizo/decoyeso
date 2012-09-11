<?php

namespace Decoyeso\ClientesBundle\Controller;

use Coobix\AdminBundle\CoobixAdminBundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Decoyeso\ClientesBundle\Entity\Cliente;
use Decoyeso\ClientesBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
   
    public function indexAction($pararouting="index")
    {
    
    
    	$buscador=$this->get("buscador");
    	$buscador->setRequest($this->getRequest());
    	$buscador->setPararouting($pararouting);
    
    	$buscador->setSql('SELECT c FROM ClientesBundle:Cliente c');
    
    	$opciones=array(
    			"c_tipo"=>array('choice',array("label"=>"Tipo de cliente",'choices'=>	array(""=>"",1 => 'Persona Física', 2 => 'Organización'))),
    			"c_nombre"=>array(null,array("label"=>"Apellido, Nombre")),
    			"c_fechaCreado"=>array("date",array("format"=>"d-m-Y",'pattern'=> '{{ day }}{{ month }}{{ year }}','label'=>'Creado eeel')),
    			"c_fechaActualizado"=>array("date",array("label"=>"Actualizado el","format"=>'d-m-Y','pattern' => '{{ day }}{{ month }}-{{ year }}',"empty_value"=>array("month"=>"Mes","year"=>"Año","day"=>"Día"))),
    			"c_cuitOcuil"=>array(null,array("label"=>"Cuit o Cuil ")),
    			"c_barrio"=>array(null,array("label"=>"Dirección - Barrio")),
    			"c_calle"=>array(null,array("label"=>"Dirección - Calle")),
    			"c_numeroCalle"=>array(null,array("label"=>"Dirección - Número")),
    			"c_numero"=>array(null,array("label"=>"Número")),
    			"c_email"=>array(null,array("label"=>"E-mail")),
    			"c_dni"=>array(null,array("label"=>"DNI"))
    			);
    	$buscador->setOpcionesForm($opciones);
    	

    
    	$resultados=$buscador->exeBuscar();
    
    
    	return $this->render('ClientesBundle:Cliente:admin_list.html.twig', array(
    			'entities' => $resultados["entities"],
    			'formBuscar'=>$resultados["form"]->createView(),
    	));
    
    
    }
   

    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ClientesBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Cliente:admin_edit.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
        $entity = new Cliente();
        $form   = $this->createForm(new ClienteType(), $entity);

        return $this->render('ClientesBundle:Cliente:admin_new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction()
    {
        $entity  = new Cliente();
        $request = $this->getRequest();
        $form    = $this->createForm(new ClienteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            //LOG
            $log = $this->get('log');
            $log->create($entity, "Cliente Creado");

            $this->get('session')->setFlash('msj_info','El cliente se ha creado correctamente');
            
            return $this->redirect($this->generateUrl('cliente_edit', array('id' => $entity->getId())));
            
        }

        return $this->render('ClientesBundle:Cliente:admin_new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ClientesBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }
        
        

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Cliente:admin_edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ClientesBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }
        
        
        $editForm   = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            //LOG
            $log = $this->get('log');
            $log->create($entity, "Cliente Actualizado");

            $this->get('session')->setFlash('msj_info','El cliente se ha modificado correctamente');
            
            return $this->redirect($this->generateUrl('cliente_edit', array('id' => $id)));
        }

        return $this->render('ClientesBundle:Cliente:admin_edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    



    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);
        
        


        if ($form->isValid()) {
        	
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ClientesBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            //LOG
            $log = $this->get('log');
            $log->create($entity, "Cliente Eliminado");
            
            $em->remove($entity);
            $em->flush();
            

        }

        return $this->redirect($this->generateUrl('cliente'));
    }
    
   

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function listDeleteformAction($id,$extra="")
    {
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('CoobixAdminBundle:Default:list_delete_form.html.twig', array(
    			'delete_form' => $deleteForm->createView(),
    			'url' => $this->generateUrl('cliente_delete', array('id' => $id)),
    			'id'=>$id,
    			'msj'=>'¿Seguro desea eliminar el cliente? ¡¡ADVERTENCIA!! Al eliminar un cliente también se eliminaran los pedidos, relevamientos y presupuestos correspondientes al mismo.'
    	));
    
    }
    
}
