<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dieta
 *
 * @ORM\Table(name="dieta")
 * @ORM\Entity
 */
class Dieta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coddieta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $coddieta;

    /**
     * @var string
     *
     * @ORM\Column(name="semana", type="string", length=100, nullable=false)
     * 
     */
    private $semana;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Diadieta", inversedBy="coddieta")
     * @ORM\JoinTable(name="lineadieta",
     *   joinColumns={
     *     @ORM\JoinColumn(name="coddieta", referencedColumnName="coddieta")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="coddia", referencedColumnName="coddia")
     *   }
     * )
     */
    private $coddia;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coddia = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get coddieta
     *
     * @return integer 
     */
    public function getCoddieta()
    {
        return $this->coddieta;
    }

    /**
     * Set semana
     *
     * @param string $semana
     * @return Dieta
     */
    public function setSemana($semana)
    {
        $this->semana = $semana;
    
        return $this;
    }

    /**
     * Get semana
     *
     * @return string 
     */
    public function getSemana()
    {
        return $this->semana;
    }

    /**
     * Add coddia
     *
     * @param \MOTO\PrincipalBundle\Entity\Diadieta $coddia
     * @return Dieta
     */
    public function addCoddia(\MOTO\PrincipalBundle\Entity\Diadieta $coddia)
    {
        $this->coddia[] = $coddia;
    
        return $this;
    }

    /**
     * Remove coddia
     *
     * @param \MOTO\PrincipalBundle\Entity\Diadieta $coddia
     */
    public function removeCoddia(\MOTO\PrincipalBundle\Entity\Diadieta $coddia)
    {
        $this->coddia->removeElement($coddia);
    }

    /**
     * Get coddia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoddia()
    {
        return $this->coddia;
    }
}