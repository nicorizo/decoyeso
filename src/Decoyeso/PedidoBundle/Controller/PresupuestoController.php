<?php

namespace Decoyeso\PedidoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Decoyeso\PedidoBundle\Entity\Presupuesto;
use Decoyeso\PedidoBundle\Form\PresupuestoType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Presupuesto controller.
 *
 */
class PresupuestoController extends Controller
{
    /**
     * Lists all Presupuesto entities.
     *
     */
	public function indexAction($pararouting="index")
    {
    	$buscador=$this->get("buscador");
    	$buscador->setRequest($this->getRequest());
    	$buscador->setPararouting($pararouting);
    
    	$buscador->setSql('SELECT pre FROM PedidoBundle:Presupuesto pre join pre.pedido p order by pre.fechaCreado desc, pre.id desc');
    
    	$opciones=array(
    			"pre_numero"=>array(null,array("label"=>"Número")),
    			"pre_fechaCreado"=>array("date",array("label"=>"Creado el","format"=>'d-m-Y','pattern' => '{{ day }}{{ month }}{{ year }}',"empty_value"=>array("month"=>"Mes","year"=>"Año","day"=>"Día"))),
    			"pre_fechaActualizado"=>array("date",array("label"=>"Actualizado el","format"=>'d-m-Y','pattern' => '{{ day }}{{ month }}{{ year }}',"empty_value"=>array("month"=>"Mes","year"=>"Año","day"=>"Día"))),
    			"p_obra"=>array(null,array("label"=>"Obra")),
    			"p_numero"=>array(null,array("label"=>"Número de pedido")),
    	);
    
    	$buscador->setOpcionesForm($opciones);
    
    	$resultados=$buscador->exeBuscar();
    
    
    	return $this->render('PedidoBundle:Presupuesto:admin_list.html.twig', array(
    			'entities' => $resultados["entities"],
    			'formBuscar'=>$resultados["form"]->createView(),
    	));
    
    
    }

    /**
     * Finds and displays a Presupuesto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presupuesto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PedidoBundle:Presupuesto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }
    
    
    

    /**
     * Displays a form to create a new Presupuesto entity.
     *
     */
    public function newAction($pedido=0)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
        $entity = new Presupuesto();
        
        
        if($pedido!=0){
        	$entityPedido=$em->getRepository('PedidoBundle:Pedido')->find($pedido);
        	$entity->setPedido($entityPedido);
        }
        
        $form   = $this->createForm(new PresupuestoType(), $entity);
        
        return $html =   $this->render('PedidoBundle:Presupuesto:admin_new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
        

     
        
    }
    
    /**
     * Displays a form to create a new Presupuesto entity.
     *
     */
    public function copiaAction($id)
    {
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);
    	
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Presupuesto entity.');
    	}
    	
    	
    	
    	$entity->setItems(json_decode($entity->getItems(), true));
    	
    	$form = $this->createForm(new PresupuestoType(), $entity);
    	
    	
        return $this->render('PedidoBundle:Presupuesto:admin_copia.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    
    
    
    }

    /**
     * Creates a new Presupuesto entity.
     *
     */
    public function createAction()
    {
        $entity  = new Presupuesto();
        $request = $this->getRequest();
        $form    = $this->createForm(new PresupuestoType(), $entity);
        $form->bindRequest($request);
        
        

        
        $items = array();
        for($i=0; $i<16; $i++):
        	$items[$i]['designacion'] = $request->get("designacion_$i");
    	    $items[$i]['unidad'] = $request->get("unidad_$i");
  	        $items[$i]['cantidad'] = $request->get("cantidad_$i");
    	    $items[$i]['precioUnitario'] = $request->get("precioUnitario_$i");
   		    $items[$i]['precioTotal'] = $request->get("precioTotal_$i");
        

        endfor;

        
        
        $entity->setItems(json_encode($items));

		
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
			
            $log = $this->get('log');
            $log->create($entity, "Presupuesto Creado");
            
            
	     $this->get('session')->setFlash('msj_info','El presupuesto se ha creado correctamente');

            return $this->redirect($this->generateUrl('presupuesto_edit',array('id'=>$entity->getId())));
        }

        return $this->render('PedidoBundle:Presupuesto:admin_new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
    
 
    
    
    public function imprimirAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Presupuesto entity.');
    	}
    
    
    	$entity->setItems(json_decode($entity->getItems(), true));
    	
    	
    	
    	$editForm = $this->createForm(new PresupuestoType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    	
    	
    	$html = $this->renderView('PedidoBundle:Presupuesto:admin_imprimir_presupuesto.html.twig', array(
    			'entity'      => $entity,
    	));
    	/*
    	return $this->render('PedidoBundle:Presupuesto:admin_imprimir_presupuesto.html.twig', array(
    			'entity'      => $entity,
    	));
    	*/
    	/*
    	 spread
    	*/
    	$pdfGenerator = $this->get('spraed.pdf.generator');
    	
    	return new Response($pdfGenerator->generatePDF($html),
    			200,
    			array(
    					'Content-Type' => 'application/pdf',
    					'Content-Disposition' => 'inline; filename="Presupuesto-'.$entity->getNumero().'.pdf"'
    			)
    	);
    	
    	
        
    }

    /**
     * Displays a form to edit an existing Presupuesto entity.
     *
     */
    public function editAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presupuesto entity.');
        }
                
        $entity->setItems(json_decode($entity->getItems(), true));
		        
        $editForm = $this->createForm(new PresupuestoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
        //number_format($precio_venta,0,",",".")
        return $this->render('PedidoBundle:Presupuesto:admin_show.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Presupuesto entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presupuesto entity.');
        }

        $editForm   = $this->createForm(new PresupuestoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
        
        $items = array();
        
        for($i=0; $i<16; $i++):
        
        $items[$i]['designacion'] = $request->get("designacion_$i");
        $items[$i]['unidad'] = $request->get("unidad_$i");
        $items[$i]['cantidad'] = $request->get("cantidad_$i");
        $items[$i]['precioUnitario'] = $request->get("precioUnitario_$i");
        $items[$i]['precioTotal'] = $request->get("precioTotal_$i");
        
        endfor;
        
        
        
        $entity->setItems(json_encode($items));

        $editForm->bindRequest($request);
       
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            //LOG
            $log = $this->get('log');
            $log->create($entity, "Presupuesto Actualizado");

            return $this->redirect($this->generateUrl('presupuesto_edit', array('id' => $id)));
        }

        return $this->render('PedidoBundle:Presupuesto:admin_edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Presupuesto entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PedidoBundle:Presupuesto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Presupuesto entity.');
            }
            
            //LOG
            $log = $this->get('log');
            $log->create($entity, "Presupuesto Eliminado");

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('presupuesto'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function listDeleteformAction($id)
    {
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('CoobixAdminBundle:Default:list_delete_form.html.twig', array(
    			'delete_form' => $deleteForm->createView(),
    			'url' => $this->generateUrl('presupuesto_delete', array('id' => $id)),
    			'id'=>$id,
    			'msj'=>'¿Seguro desea eliminar el presupuesto?'
    	));
    
    }
    
}
