<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity
 */
class Plan
{
    /**
     * @var string
     *
     * @ORM\Column(name="codPlan", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Assert\MaxLenght(10)
     */
    private $codplan;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoplan", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $tipoplan;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     * 
     */
    private $descripcion;



    /**
     * Get codplan
     *
     * @return string 
     */
    public function getCodplan()
    {
        return $this->codplan;
    }

    /**
     * Set tipoplan
     *
     * @param string $tipoplan
     * @return Plan
     */
    public function setTipoplan($tipoplan)
    {
        $this->tipoplan = $tipoplan;
    
        return $this;
    }

    /**
     * Get tipoplan
     *
     * @return string 
     */
    public function getTipoplan()
    {
        return $this->tipoplan;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Plan
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function __toString()
    {
        return $this->tipoplan . ': ' . $this->descripcion;
    }
}