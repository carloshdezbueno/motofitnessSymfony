<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Plato
 *
 * @ORM\Table(name="plato")
 * @ORM\Entity
 */
class Plato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codplato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $codplato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     * 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=50, nullable=false)
     * 
     */
    private $link;

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
     * @ORM\Column(name="tipoComida", type="string", length=20, nullable=false)
     * 
     */
    private $tipocomida;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Diadieta", mappedBy="codplato")
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
     * Get codplato
     *
     * @return integer 
     */
    public function getCodplato()
    {
        return $this->codplato;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Plato
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
     * Set link
     *
     * @param string $link
     * @return Plato
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
     * Set calorias
     *
     * @param integer $calorias
     * @return Plato
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
     * Set tipocomida
     *
     * @param string $tipocomida
     * @return Plato
     */
    public function setTipocomida($tipocomida)
    {
        $this->tipocomida = $tipocomida;
    
        return $this;
    }

    /**
     * Get tipocomida
     *
     * @return string 
     */
    public function getTipocomida()
    {
        return $this->tipocomida;
    }

    /**
     * Add coddia
     *
     * @param \MOTO\PrincipalBundle\Entity\Diadieta $coddia
     * @return Plato
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