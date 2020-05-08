<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diadieta
 *
 * @ORM\Table(name="diadieta")
 * @ORM\Entity
 */
class Diadieta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coddia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $coddia;

    /**
     * @var integer
     *
     * @ORM\Column(name="calorias", type="integer", nullable=false)
     * 
     */
    private $calorias;

    /**
     * @var string
     *
     * @ORM\Column(name="macronutrientes", type="string", length=50, nullable=false)
     * 
     */
    private $macronutrientes;

    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=20, nullable=false)
     * 
     */
    private $dia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Plato", inversedBy="coddia")
     * @ORM\JoinTable(name="lineadia",
     *   joinColumns={
     *     @ORM\JoinColumn(name="coddia", referencedColumnName="coddia")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="codplato", referencedColumnName="codplato")
     *   }
     * )
     */
    private $codplato;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Dieta", mappedBy="coddia")
     */
    private $coddieta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codplato = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coddieta = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get coddia
     *
     * @return integer 
     */
    public function getCoddia()
    {
        return $this->coddia;
    }

    /**
     * Set calorias
     *
     * @param integer $calorias
     * @return Diadieta
     */
    public function setCalorias($calorias)
    {
        $this->calorias = $calorias;
    
        return $this;
    }

    /**
     * Get calorias
     *
     * @return integer 
     */
    public function getCalorias()
    {
        return $this->calorias;
    }

    /**
     * Set macronutrientes
     *
     * @param string $macronutrientes
     * @return Diadieta
     */
    public function setMacronutrientes($macronutrientes)
    {
        $this->macronutrientes = $macronutrientes;
    
        return $this;
    }

    /**
     * Get macronutrientes
     *
     * @return string 
     */
    public function getMacronutrientes()
    {
        return $this->macronutrientes;
    }

    /**
     * Set dia
     *
     * @param string $dia
     * @return Diadieta
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
     * Add codplato
     *
     * @param \MOTO\PrincipalBundle\Entity\Plato $codplato
     * @return Diadieta
     */
    public function addCodplato(\MOTO\PrincipalBundle\Entity\Plato $codplato)
    {
        $this->codplato[] = $codplato;
    
        return $this;
    }

    /**
     * Remove codplato
     *
     * @param \MOTO\PrincipalBundle\Entity\Plato $codplato
     */
    public function removeCodplato(\MOTO\PrincipalBundle\Entity\Plato $codplato)
    {
        $this->codplato->removeElement($codplato);
    }

    /**
     * Get codplato
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodplato()
    {
        return $this->codplato;
    }

    /**
     * Add coddieta
     *
     * @param \MOTO\PrincipalBundle\Entity\Dieta $coddieta
     * @return Diadieta
     */
    public function addCoddieta(\MOTO\PrincipalBundle\Entity\Dieta $coddieta)
    {
        $this->coddieta[] = $coddieta;
    
        return $this;
    }

    /**
     * Remove coddieta
     *
     * @param \MOTO\PrincipalBundle\Entity\Dieta $coddieta
     */
    public function removeCoddieta(\MOTO\PrincipalBundle\Entity\Dieta $coddieta)
    {
        $this->coddieta->removeElement($coddieta);
    }

    /**
     * Get coddieta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoddieta()
    {
        return $this->coddieta;
    }
    
    public function __toString() {
        return $this->coddia . ".";
    }
}