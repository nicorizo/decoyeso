<?php

namespace Decoyeso\PedidoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Decoyeso\PedidoBundle\Entity\Presupuesto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Decoyeso\PedidoBundle\Entity\PresupuestoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Presupuesto
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
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="string", length=12, nullable="true")
     */
    protected $numero;
    
    /**
     * @var string $subTotal
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     * @ORM\Column(name="subTotal", type="string", length=255)
     */
    protected $subTotal;
    
    /**
     * @var string $total
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     * @ORM\Column(name="total", type="string", length=255)
     */
    protected $total;
    
    /**
     * @var string $precioEntrega
     * @Assert\MaxLength(255)
     * @ORM\Column(name="precioEntrega", type="string", length=255, nullable="true")
     */
    protected $precioEntrega;
    
    /**
     * @var string $precioTextoEntrega
     * @Assert\MaxLength(255)
     * @ORM\Column(name="precioTextoEntrega", type="string", length=255, nullable="true")
     */
    protected $precioTextoEntrega;
    
    /**
     * @var string $precioSaldo
     * @Assert\MaxLength(255)
     * @ORM\Column(name="precioSaldo", type="string", length=255, nullable="true")
     */
    protected $precioSaldo;
    
    /**
     * @var string $formaPago
     * @Assert\MaxLength(255)
     * @ORM\Column(name="formaPago", type="string", length=255, nullable="true")
     */
    protected $formaPago;
    
         

    /**
     * @var string $pedido
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="presupuestos" )
     */
    protected $pedido;
    
    /**
     * @var text $items
     * 
     * @ORM\Column(name="items", type="text")
     */
    protected $items;
    
    /**
     * @var text $mostrarColumnas
     * @Assert\MaxLength(255)
     * @ORM\Column(name="mostrarColumnas", type="string", length=255, nullable="true")
     */
    protected $mostrarColumnas;
    

      
    /**
     *
     * @ORM\ManyToMany(targetEntity="Decoyeso\ProductoBundle\Entity\Producto")
     * @ORM\JoinTable(name="Presupuesto_Producto",
     *      joinColumns={@ORM\JoinColumn(name="presupuesto", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="producto", referencedColumnName="id")}
     *      )
     */
    //private $producto;

    /**
     * @var date $fechaCreado
     *
     * @ORM\Column(name="fechaCreado", type="date")
     */
    private $fechaCreado;
    
    /**
     * @var date $fechaActualizado
     *
     * @ORM\Column(name="fechaActualizado", type="date")
     */
    private $fechaActualizado;
    
    
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
    	$this->numero= "PRES".str_pad($this->getId(),5,0,STR_PAD_LEFT);
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
     * Set pedido
     *
     * @param integer $pedido
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get pedido
     *
     * @return integer 
     */
    public function getPedido()
    {
        return $this->pedido;
    }


    /**
     * Add producto
     *
     * @param Decoyeso\PedidoBundle\Entity\Producto $producto
     */
    public function addProducto(\Decoyeso\PedidoBundle\Entity\Producto $producto)
    {
        $this->producto[] = $producto;
    }

    /**
     * Get producto
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProducto()
    {
        return $this->producto;
    }
    
    public function setProducto($producto)
    {
    	$this->producto=$producto;
    }
    public function __construct()
    {
        $this->producto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set items
     *
     * @param text $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * Get items
     *
     * @return text 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set subTotal
     *
     * @param string $subTotal
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;
    }

    /**
     * Get subTotal
     *
     * @return string 
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set total
     *
     * @param string $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set precioEntrega
     *
     * @param string $precioEntrega
     */
    public function setPrecioEntrega($precioEntrega)
    {
        $this->precioEntrega = $precioEntrega;
    }

    /**
     * Get precioEntrega
     *
     * @return string 
     */
    public function getPrecioEntrega()
    {
        return $this->precioEntrega;
    }

    /**
     * Set precioTextoEntrega
     *
     * @param string $precioTextoEntrega
     */
    public function setPrecioTextoEntrega($precioTextoEntrega)
    {
        $this->precioTextoEntrega = $precioTextoEntrega;
    }

    /**
     * Get precioTextoEntrega
     *
     * @return string 
     */
    public function getPrecioTextoEntrega()
    {
        return $this->precioTextoEntrega;
    }

    /**
     * Set precioSaldo
     *
     * @param string $precioSaldo
     */
    public function setPrecioSaldo($precioSaldo)
    {
        $this->precioSaldo = $precioSaldo;
    }

    /**
     * Get precioSaldo
     *
     * @return string 
     */
    public function getPrecioSaldo()
    {
        return $this->precioSaldo;
    }

    /**
     * Set formaPago
     *
     * @param string $formaPago
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;
    }

    /**
     * Get formaPago
     *
     * @return string 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }


    

    /**
     * Set mostrarColumnas
     *
     * @param integer $mostrarColumnas
     */
    public function setMostrarColumnas($mostrarColumnas)
    {
    	
        $this->mostrarColumnas = json_encode($mostrarColumnas);
    }

    /**
     * Get mostrarColumnas
     *
     * @return integer 
     */
    public function getMostrarColumnas()
    {
        return json_decode($this->mostrarColumnas, true);
    }
}