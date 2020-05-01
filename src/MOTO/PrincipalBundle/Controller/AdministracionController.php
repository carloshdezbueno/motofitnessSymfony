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
        $_SESSION['dni'] = "33333333P";
        if($_SESSION['resLogin'] == "empleado"){
            
            $em = $this->getDoctrine()->getEntityManager();
            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e";
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $empleados = $queryEmpleado->getResult();
            
            $dietas = "-";
            $tablas = "-";
            $empleados = "-";
            
            foreach ($empleados as $empleado) {
                if ($empleado->getDniempleado() == $_SESSION['dni']) {
                    if($empleado->getPrivilegios() == 1){
                        $empleados = "true";
                    }
                    if($empleado->getEspecialidad() == 1){
                        // Nutricion
                        $dietas = "true";
                    }
                    else if($empleado->getEspecialidad() == 2){
                        // Entrenamiento
                        $tablas = "true";
                    }
                    else if($empleado->getEspecialidad() == 3){
                        // Ambas
                        $tablas = "true";
                        $dietas = "true";
                    }
                }
            }
            
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
    
    public function nuevaSesionAction()
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
