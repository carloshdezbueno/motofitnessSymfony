<?php

namespace MOTO\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Cliente {

    /**
     * @ORM\prePersist
     */
    public function setValorVencimiento() {


        
        
        $this->vencimiento = new \DateTime();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9, nullable=false)
     * @ORM\Id
     * 
     * @Assert\NotNull
     * @Assert\MaxLenght(9)
     */
    private $dni;

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
     * @ORM\Column(name="telefono", type="string", length=9, nullable=false)
     * 
     * @Assert\MaxLenght(9)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=20, nullable=false)
     * 
     * @Assert\MaxLenght(20)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilidad", type="string", length=30, nullable=false)
     * 
     * @Assert\MaxLenght(30)
     */
    private $disponibilidad;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=false)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="date", nullable=true)
     */
    private $vencimiento;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * 
     * @ORM\ManyToMany(targetEntity="Empleado", inversedBy="dni")
     * 
     * 
     * @ORM\JoinTable(name="lineaempleado",
     *   joinColumns={
     *     @ORM\JoinColumn(name="dni", referencedColumnName="dni")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="numeroempleado", referencedColumnName="numeroempleado")
     *   }
     * )
     */
    private $numeroempleado;

    

    /**
     * @var \Dieta
     *
     * @ORM\ManyToOne(targetEntity="Dieta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coddieta", referencedColumnName="coddieta")
     * })
     * 
     */
    private $coddieta;

    /**
     * @var \Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codplan", referencedColumnName="codPlan")
     * })
     * 
     */
    private $codplan;

    /**
     * @var \Tablaejercicios
     *
     * @ORM\ManyToOne(targetEntity="Tablaejercicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codtabla", referencedColumnName="codtabla")
     * })
     */
    private $codtabla;

    /**
     * Constructor
     */
    public function __construct() {
        $this->numeroempleado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Cliente
     */
    public function setDni($dni) {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni() {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cliente
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     * @return Cliente
     */
    public function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string 
     */
    public function getObjetivo() {
        return $this->objetivo;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return Cliente
     */
    public function setClave($clave) {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave() {
        return $this->clave;
    }

    /**
     * Set disponibilidad
     *
     * @param string $disponibilidad
     * @return Cliente
     */
    public function setDisponibilidad($disponibilidad) {
        $this->disponibilidad = $disponibilidad;

        return $this;
    }

    /**
     * Get disponibilidad
     *
     * @return string 
     */
    public function getDisponibilidad() {
        return $this->disponibilidad;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Cliente
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     * @return Cliente
     */
    public function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime 
     */
    public function getVencimiento() {
        return $this->vencimiento;
    }

    /**
     * Add numeroempleado
     *
     * @param \MOTO\PrincipalBundle\Entity\Empleado $numeroempleado
     * @return Cliente
     */
    public function addNumeroempleado(\MOTO\PrincipalBundle\Entity\Empleado $numeroempleado) {
        $this->numeroempleado[] = $numeroempleado;

        return $this;
    }

    /**
     * Remove numeroempleado
     *
     * @param \MOTO\PrincipalBundle\Entity\Empleado $numeroempleado
     */
    public function removeNumeroempleado(\MOTO\PrincipalBundle\Entity\Empleado $numeroempleado) {
        $this->numeroempleado->removeElement($numeroempleado);
    }

    /**
     * Get numeroempleado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNumeroempleado() {
        return $this->numeroempleado;
    }

    /**
     * Set coddieta
     *
     * @param \MOTO\PrincipalBundle\Entity\Dieta $coddieta
     * @return Cliente
     */
    public function setCoddieta(\MOTO\PrincipalBundle\Entity\Dieta $coddieta = null) {
        $this->coddieta = $coddieta;

        return $this;
    }

    /**
     * Get coddieta
     *
     * @return \MOTO\PrincipalBundle\Entity\Dieta 
     */
    public function getCoddieta() {
        return $this->coddieta;
    }

    /**
     * Set codplan
     *
     * @param \MOTO\PrincipalBundle\Entity\Plan $codplan
     * @return Cliente
     */
    public function setCodplan(\MOTO\PrincipalBundle\Entity\Plan $codplan = null) {
        $this->codplan = $codplan;

        return $this;
    }

    /**
     * Get codplan
     *
     * @return \MOTO\PrincipalBundle\Entity\Plan 
     */
    public function getCodplan() {
        return $this->codplan;
    }

    /**
     * Set codtabla
     *
     * @param \MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla
     * @return Cliente
     */
    public function setCodtabla(\MOTO\PrincipalBundle\Entity\Tablaejercicios $codtabla = null) {
        $this->codtabla = $codtabla;

        return $this;
    }

    /**
     * Get codtabla
     *
     * @return \MOTO\PrincipalBundle\Entity\Tablaejercicios 
     */
    public function getCodtabla() {
        return $this->codtabla;
    }
    
    public function __toString() {
        return "Nombre: " . $this->nombre . "-Dni:" . $this->dni;
    }

}
