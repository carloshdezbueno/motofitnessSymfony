<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sesion
 *
 * @ORM\Table(name="sesion")
 * @ORM\Entity
 */
class Sesion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codsesion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $codsesion;

    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=20, nullable=false)
     * 
     * @Assert\Length(max=20)
     * @Assert\Type("string")
     */
    private $dia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ejercicio", mappedBy="codigosesion")
     */
    private $codigoejercicio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tablaejercicios", mappedBy="codsesion")
     */
    private $codtabla;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codigoejercicio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->codtabla = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get codsesion
     *
     * @return integer 
     */
    public function getCodsesion()
    {
        return $this->codsesion;
    }

    /**
     * Set dia
     *
     * @param string $dia
     * @return Sesion
     */
    public function setDia($dia)
    {
        $this->dia = $dia;
    
        return $this;
    }

    /**
     * Get dia
     *
     * @return string 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Add codigoejercicio
     *
     * @param \MOTO\PrincipalBundle\Entity\Ejercicio $codigoejercicio
     * @return Sesion
     */
    public function addCodigoejercicio(\MOTO\PrincipalBundle\Entity\Ejercicio $codigoejercicio)
    {
        $this->codigoejercicio[] = $codigoejercicio;
    
        return $this;
    }

    /**
     * Remove codigoejercicio
     *
     * @param \MOTO\PrincipalBundle\Entity\Ejercicio $codigoejercicio
     */
    public function removeCodigoejercicio(\MOTO\PrincipalBundle\Entity\Ejercicio $codigoejercicio)
    {
        $this->codigoejercicio->removeElement($codigoejercicio);
    }

    /**
     * Get codigoejercicio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodigoejercicio()
    {
        return $this->codigoejercicio;
    }

    /**
     * Add codtabla
     *
     * @param \MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla
     * @return Sesion
     */
    public function addCodtabla(\MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla)
    {
        $this->codtabla[] = $codtabla;
    
        return $this;
    }

    /**
     * Remove codtabla
     *
     * @param \MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla
     */
    public function removeCodtabla(\MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla)
    {
        $this->codtabla->removeElement($codtabla);
    }

    /**
     * Get codtabla
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodtabla()
    {
        return $this->codtabla;
    }
    
    public function __tostring(){
        return "Sesión número: " . $this->codsesion . " - Dia: " . $this->dia;
    }
}