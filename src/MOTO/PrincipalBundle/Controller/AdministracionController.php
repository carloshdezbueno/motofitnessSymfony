<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller
{
    public function principalAdministracionAction()
    {
        session_start();
        
        // Si es un empleado
        $_SESSION['resLogin'] = "empleado";
        if($_SESSION['resLogin'] == "empleado"){
            // Comporbar si gestiona dietas
            // if gestiona dietas == true
            $dietas = "true";
            
            // Comprobar si gestiona tablas
            $tablas = "true";
            
            // Comporbar si gestiona empleados
            $empleados = "true";
            
            // Buscador de clientes
            
            return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("login"=>"true", "dietas"=>$dietas, "tablas"=>$tablas, "empleados"=>$empleados));
        }
        
        // Si no es un empleado
        $nota = "No tienes permisos para acceder aquí";
        return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("nota"=>$nota));
    }

    public function asignarDietaAction()
    {
    }

    public function crearDietaAction()
    {
    }

    public function verDietaAction()
    {
    }

    public function asignarTablaClienteAction()
    {
    }

    public function nuevaTablaAction()
    {
    }

    public function nuevoEjercicioAction()
    {
    }

    public function nuevoEmpleadoAction()
    {
    }

    public function gestionarEmpleadosAction()
    {
    }

    public function buscarClienteAction()
    {
    }

}
