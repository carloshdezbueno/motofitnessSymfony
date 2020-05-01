<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Empleado
 *
 * @ORM\Table(name="empleado")
 * @ORM\Entity
 */
class Empleado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numeroempleado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Assert\Max(10)
     */
    private $numeroempleado;

    /**
     * @var integer
     *
     * @ORM\Column(name="especialidad", type="integer", nullable=false)
     * 
     * @Assert\Max(1)
     */
    private $especialidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="dniEmpleado", type="string", length=9, nullable=false)
     * 
     * @Assert\MaxLenght(9)
     * @Assert\MinLenght(9)
     */
    private $dniempleado;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=9, nullable=false)
     * 
     * @Assert\Max(9)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     * 
     * @Assert\MaxLenght(50)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $clave;

    /**
     * @var integer
     *
     * @ORM\Column(name="privilegios", type="integer", nullable=false)
     */
    private $privilegios;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cliente", mappedBy="numeroempleado")
     *
     * 
     */
    private $dni;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dni = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get numeroempleado
     *
     * @return integer 
     */
    public function getNumeroempleado()
    {
        return $this->numeroempleado;
    }

    /**
     * Set especialidad
     *
     * @param integer $especialidad
     * @return Empleado
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    
        return $this;
    }

    /**
     * Get especialidad
     *
     * @return integer 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Empleado
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
     * Set dniempleado
     *
     * @param string $dniempleado
     * @return Empleado
     */
    public function setDniempleado($dniempleado)
    {
        $this->dniempleado = $dniempleado;
    
        return $this;
    }

    /**
     * Get dniempleado
     *
     * @return string 
     */
    public function getDniempleado()
    {
        return $this->dniempleado;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Empleado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Empleado
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empleado
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return Empleado
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    
        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set privilegios
     *
     * @param integer $privilegios
     * @return Empleado
     */
    public function setPrivilegios($privilegios)
    {
        $this->privilegios = $privilegios;
    
        return $this;
    }

    /**
     * Get privilegios
     *
     * @return integer 
     */
    public function getPrivilegios()
    {
        return $this->privilegios;
    }

    /**
     * Add dni
     *
     * @param \MOTO\PrincipalBundle\Entity\Cliente $dni
     * @return Empleado
     */
    public function addDni(\MOTO\PrincipalBundle\Entity\Cliente $dni)
    {
        $this->dni[] = $dni;
    
        return $this;
    }

    /**
     * Remove dni
     *
     * @param \MOTO\PrincipalBundle\Entity\Cliente $dni
     */
    public function removeDni(\MOTO\PrincipalBundle\Entity\Cliente $dni)
    {
        $this->dni->removeElement($dni);
    }

    /**
     * Get dni
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDni()
    {
        return $this->dni;
    }
}