<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ejercicio
 *
 * @ORM\Table(name="ejercicio")
 * @ORM\Entity
 */
class Ejercicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codejercicio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $codejercicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     * 
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="series", type="integer", nullable=false)
     * 
     */
    private $series;

    /**
     * @var integer
     *
     * @ORM\Column(name="repeticiones", type="integer", nullable=false)
     * 
     */
    private $repeticiones;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", nullable=false)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=50, nullable=false)
     * 
     */
    private $link;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sesion", inversedBy="codigoejercicio")
     * @ORM\JoinTable(name="entrenamiento",
     *   joinColumns={
     *     @ORM\JoinColumn(name="codigoejercicio", referencedColumnName="codejercicio")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="codigosesion", referencedColumnName="codsesion")
     *   }
     * )
     */
    private $codigosesion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codigosesion = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get codejercicio
     *
     * @return integer 
     */
    public function getCodejercicio()
    {
        return $this->codejercicio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Ejercicio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set series
     *
     * @param integer $series
     * @return Ejercicio
     */
    public function setSeries($series)
    {
        $this->series = $series;
    
        return $this;
    }

    /**
     * Get series
     *
     * @return integer 
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set repeticiones
     *
     * @param integer $repeticiones
     * @return Ejercicio
     */
    public function setRepeticiones($repeticiones)
    {
        $this->repeticiones = $repeticiones;
    
        return $this;
    }

    /**
     * Get repeticiones
     *
     * @return integer 
     */
    public function getRepeticiones()
    {
        return $this->repeticiones;
    }

    /**
     * Set peso
     *
     * @param float $peso
     * @return Ejercicio
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
     * Set link
     *
     * @param string $link
     * @return Ejercicio
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Add codigosesion
     *
     * @param \MOTO\PrincipalBundle\Entity\Sesion $codigosesion
     * @return Ejercicio
     */
    public function addCodigosesion(\MOTO\PrincipalBundle\Entity\Sesion $codigosesion)
    {
        $this->codigosesion[] = $codigosesion;
    
        return $this;
    }

    /**
     * Remove codigosesion
     *
     * @param \MOTO\PrincipalBundle\Entity\Sesion $codigosesion
     */
    public function removeCodigosesion(\MOTO\PrincipalBundle\Entity\Sesion $codigosesion)
    {
        $this->codigosesion->removeElement($codigosesion);
    }

    /**
     * Get codigosesion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodigosesion()
    {
        return $this->codigosesion;
    }
}