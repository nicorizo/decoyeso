<?php

namespace Decoyeso\PedidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Decoyeso\PedidoBundle\Entity\Relevamiento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Decoyeso\PedidoBundle\Entity\RelevamientoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Relevamiento
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
     * @ORM\Column(name="numero", type="string", length=12, nullable="true")
     */
    private $numero;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string $barrio
     *
     * @ORM\Column(name="barrio", type="string", length=255, nullable="true")
     */
    private $barrio;

    /**
     * @var string $calle
     *
     * @ORM\Column(name="calle", type="string", length=255, nullable="true")
     */
    private $calle;

    /**
     * @var string $numeroCalle
     *
     * @ORM\Column(name="numeroCalle", type="string", length=255, nullable="true")
     */
    private $numeroCalle;
    
    
    

    
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
     * @var Pedido $pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="relevamientos")
     */
    protected $pedido;
    
    /**
     * @ORM\prePersist
     */
    public function prePersist()
    {
    	$this->setFechaCreado (new \DateTime);
    	$this->setFechaActualizado (new \DateTime);
    }
    
    /**
     * @ORM\preUpdate
     */
    public function preUpdate()
    {
    	$this->setFechaActualizado (new \DateTime);
    }
    
    
    /**
     * @ORM\postPersist
     */
    public function postPersist()
    {
    	$this->numero="REL".str_pad($this->getId(),5,0,STR_PAD_LEFT);
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
     * Set barrio
     *
     * @param string $barrio
     */
    public function setBarrio($barrio)
    {
        $this->barrio = $barrio;
    }

    /**
     * Get barrio
     *
     * @return string 
     */
    public function getBarrio()
    {
        return $this->barrio;
    }

    /**
     * Set calle
     *
     * @param string $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
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
     * Set pedido
     *
     * @param Decoyeso\PedidoBundle\Entity\Pedido $pedido
     */
    public function setPedido(\Decoyeso\PedidoBundle\Entity\Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get pedido
     *
     * @return Decoyeso\PedidoBundle\Entity\Pedido 
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set numeroCalle
     *
     * @param string $numeroCalle
     */
    public function setNumeroCalle($numeroCalle)
    {
        $this->numeroCalle = $numeroCalle;
    }

    /**
     * Get numeroCalle
     *
     * @return string 
     */
    public function getNumeroCalle()
    {
        return $this->numeroCalle;
    }
}