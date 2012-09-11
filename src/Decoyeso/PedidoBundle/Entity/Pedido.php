<?php

namespace Decoyeso\PedidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido\PedidoBundle\Entity\Pedido
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Pedido
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var integer $numero
     *
     * @ORM\Column(name="numero", type="string",length="12",nullable="true")
     */
    private $numero;

    /**
     * @var $cliente
     *
     * @ORM\ManyToOne(targetEntity="Decoyeso\ClientesBundle\Entity\Cliente", inversedBy="pedidos")
     */
    private $cliente;
    
    /**
     * @ORM\Column(name="requiereRelevamiento", type="boolean")
     */
    private $requiereRelevamiento;
    
    /**
     * 
     * @var $estado (1-En espera,2-Procesado)
     * @ORM\Column(name="estado", type="integer", nullable="true")
     * 
     */
    private $estado;

    /**
     * var $prioridad;
     * @ORM\Column(name="prioridad",type="integer")
     */
    private $prioridad;
    

    /**
     * @var string $obra
     *
     * @ORM\Column(name="obra", type="string", length="255")
     */
    private $obra;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable="true")
     */
    private $descripcion;


    
    /**
     * @var date $fechaSolicitado
     *
     * @ORM\Column(name="fechaSolicitado", type="date")
     */
    protected $fechaSolicitado;
    
    /**
     * @var date $fechaEntrega
     *
     * @ORM\Column(name="fechaEntrega", type="date")
     */
    protected $fechaEntrega;

    /**
     * @var date $fechaCreado
     *
     * @ORM\Column(name="fechaCreado", type="date")
     */
    protected $fechaCreado;
    
    /**
     * @var date $fechaActualizado
     *
     * @ORM\Column(name="fechaActualizado", type="date")
     */
    protected $fechaActualizado;
    
    /**
     * @var Relevamiento $relevamientos
     *
     * @ORM\OneToMany(targetEntity="Relevamiento", mappedBy="pedido", cascade={"remove"}))
     */
    protected $relevamientos;
    
    /**
     * @var Presupuesto $presupuestos
     *
     * @ORM\OneToMany(targetEntity="Presupuesto", mappedBy="pedido", cascade={"remove"}))
     */
    protected $presupuestos;
    
    
    /**
     * @ORM\prePersist
     */
    public function prePersist()
    {
    	$this->setFechaCreado (new \DateTime);
    	$this->setFechaActualizado (new \DateTime);
    	$this->estado=1;
    }
    
    /**
     * @ORM\postPersist
     */
    public function postPersist()
    {
    	$this->numero="PED".str_pad($this->getId(),5,0,STR_PAD_LEFT);
    }
    
    /**
     * @ORM\preUpdate
     */
    public function preUpdate()
    {
    	$this->setFechaActualizado (new \DateTime);
    }

    public function __toString()
    {
    	return $this->numero."-".$this->obra;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param text $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return text 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaSolicitado
     *
     * @param date $fechaSolicitado
     */
    public function setFechaSolicitado($fechaSolicitado)
    {
        $this->fechaSolicitado = $fechaSolicitado;
    }

    /**
     * Get fechaSolicitado
     *
     * @return date 
     */
    public function getFechaSolicitado()
    {
        return $this->fechaSolicitado;
    }

    /**
     * Set fechaCreado
     *
     * @param date $fechaCreado
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;
    }

    /**
     * Get fechaCreado
     *
     * @return date 
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set fechaActualizado
     *
     * @param date $fechaActualizado
     */
    public function setFechaActualizado($fechaActualizado)
    {
        $this->fechaActualizado = $fechaActualizado;
    }

    /**
     * Get fechaActualizado
     *
     * @return date 
     */
    public function getFechaActualizado()
    {
        return $this->fechaActualizado;
    }

    /**
     * Set cliente
     *
     * @param Decoyeso\ClientesBundle\Entity\Cliente $cliente
     */
    public function setCliente(\Decoyeso\ClientesBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Get cliente
     *
     * @return Decoyeso\ClientesBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set obra
     *
     * @param string $obra
     */
    public function setObra($obra)
    {
        $this->obra = $obra;
    }

    /**
     * Get obra
     *
     * @return string 
     */
    public function getObra()
    {
        return $this->obra;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }
    public function __construct()
    {
        $this->relevamientos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add relevamientos
     *
     * @param Decoyeso\PedidoBundle\Entity\Relevamiento $relevamientos
     */
    public function addRelevamiento(\Decoyeso\PedidoBundle\Entity\Relevamiento $relevamientos)
    {
        $this->relevamientos[] = $relevamientos;
    }

    /**
     * Get relevamientos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRelevamientos()
    {
        return $this->relevamientos;
    }

    /**
     * Add presupuestos
     *
     * @param Decoyeso\PedidoBundle\Entity\Presupuesto $presupuestos
     */
    public function addPresupuesto(\Decoyeso\PedidoBundle\Entity\Presupuesto $presupuestos)
    {
        $this->presupuestos[] = $presupuestos;
    }

    /**
     * Get presupuestos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPresupuestos()
    {
        return $this->presupuestos;
    }
    
    public function getRequiereRelevamiento(){
    	return $this->requiereRelevamiento;
    }
    
    public function setRequiereRelevamiento($requiereRelevamiento){
    	$this->requiereRelevamiento=$requiereRelevamiento;
    }
    
    public function getRequiereRelevamientoNombre(){
    	
    	switch ($this->getRequiereRelevamiento()){
    		
    		case 1:
    			return "No";
    		break;
    		
    		case 2:
    			return "Si";
    		break;
    	}
    	
    }

    /**
     * Set estado
     *
     * @param integer $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
    	return $this->estado;
    }
    
    //Devuelve el nombre del estado
    
    public function getEstadoNombre(){
    	
    	switch ($this->getEstado()){
    		case 1:
    			return "En espera";
    		break;
    		
    		case 2:
    			return "Gestionado";
    		break;

    	}
    }
    
    public function verificarEstado(){
    	if(count($this->getRelevamientos())==0 and count($this->getPresupuestos())==0){
    		$this->estado=1;
    	}else{
    		$this->estado=2;
    	}
    }
    
    

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;
    }

    /**
     * Get prioridad
     *
     * @return integer 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }
    
    
    public function getPrioridadNombre(){
    
    	switch ($this->getPrioridad()){
    		case 1:
    			return "Baja";
    			break;
    
    		case 2:
    			return "Media";
    		break;
    		
    		case 3:
    			return "Alta";
    		break;
    		
    		case 4:
    			return "Muy alta";
    		break;
    	}
    }

    /**
     * Set fechaEntrega
     *
     * @param date $fechaEntrega
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;
    }

    /**
     * Get fechaEntrega
     *
     * @return date 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }
}