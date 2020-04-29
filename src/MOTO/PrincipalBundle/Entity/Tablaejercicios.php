<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tablaejercicios
 *
 * @ORM\Table(name="tablaejercicios")
 * @ORM\Entity
 */
class Tablaejercicios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codtabla", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codtabla;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=false)
     */
    private $tipo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sesion", inversedBy="codtabla")
     * @ORM\JoinTable(name="lineatabla",
     *   joinColumns={
     *     @ORM\JoinColumn(name="codtabla", referencedColumnName="codtabla")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="codsesion", referencedColumnName="codsesion")
     *   }
     * )
     */
    private $codsesion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codsesion = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get codtabla
     *
     * @return integer 
     */
    public function getCodtabla()
    {
        return $this->codtabla;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Tablaejercicios
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
     * Set tipo
     *
     * @param string $tipo
     * @return Tablaejercicios
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add codsesion
     *
     * @param \MOTO\PrincipalBundle\Entity\Sesion $codsesion
     * @return Tablaejercicios
     */
    public function addCodsesion(\MOTO\PrincipalBundle\Entity\Sesion $codsesion)
    {
        $this->codsesion[] = $codsesion;
    
        return $this;
    }

    /**
     * Remove codsesion
     *
     * @param \MOTO\PrincipalBundle\Entity\Sesion $codsesion
     */
    public function removeCodsesion(\MOTO\PrincipalBundle\Entity\Sesion $codsesion)
    {
        $this->codsesion->removeElement($codsesion);
    }

    /**
     * Get codsesion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodsesion()
    {
        return $this->codsesion;
    }
}