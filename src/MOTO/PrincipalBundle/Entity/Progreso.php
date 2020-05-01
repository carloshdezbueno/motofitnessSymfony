<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Progreso
 *
 * @ORM\Table(name="progreso")
 * @ORM\Entity
 */
class Progreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codProgreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Assert\Max(10)
     */
    private $codprogreso;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=100, nullable=true)
     * 
     * @Assert\MaxLenght(100)
     */
    private $imagen;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", nullable=false)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="medidas", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $medidas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dni", referencedColumnName="dni")
     * })
     * 
     * @Assert\MaxLenght(9)
     * @Assert\MinLenght(9)
     */
    private $dni;



    /**
     * Get codprogreso
     *
     * @return integer 
     */
    public function getCodprogreso()
    {
        return $this->codprogreso;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Progreso
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set peso
     *
     * @param float $peso
     * @return Progreso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    
        return $this;
    }

    /**
     * Get peso
     *
     * @return float 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set medidas
     *
     * @param string $medidas
     * @return Progreso
     */
    public function setMedidas($medidas)
    {
        $this->medidas = $medidas;
    
        return $this;
    }

    /**
     * Get medidas
     *
     * @return string 
     */
    public function getMedidas()
    {
        return $this->medidas;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Progreso
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set dni
     *
     * @param \MOTO\PrincipalBundle\Entity\Cliente $dni
     * @return Progreso
     */
    public function setDni(\MOTO\PrincipalBundle\Entity\Cliente $dni = null)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return \MOTO\PrincipalBundle\Entity\Cliente 
     */
    public function getDni()
    {
        return $this->dni;
    }
}