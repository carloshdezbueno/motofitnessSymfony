<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller {

    public function principalAdministracionAction() {
        session_start();
        if ($_SESSION['resLogin'] == "empleado") {

            $em = $this->getDoctrine()->getEntityManager();
            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $_SESSION['dni'];
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $empleadosCons = $queryEmpleado->getResult();
            
            $dietas = "-";
            $tablas = "-";
            $empleadosAdmin = "-";

            if ($empleados[0] != null) {

                if ($empleados[0]->getPrivilegios() == 1) {

                    $empleadosAdmin = "true";
                }

                if ($empleados[0]->getEspecialidad() == 1) {
                    // Nutricion
                    $dietas = "true";
                } else if ($empleados[0]->getEspecialidad() == 2) {
                    // Entrenamiento
                    $tablas = "true";
                } else if ($empleados[0]->getEspecialidad() == 3) {
                    // Ambas
                    $tablas = "true";
                    $dietas = "true";
                }
            }


            // Buscador de clientes

            return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("administrador" => "true", "dietas" => $dietas, "tablas" => $tablas, "empleados" => $empleadosAdmin));
        }

        // Si no es un empleado
        $nota = "No tienes permisos para acceder aquí";
        return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("nota" => $nota));
    }

    public function asignarDietaAction() {
        
    }

    public function crearDietaAction() {
        
    }

    public function verDietaAction() {
        
    }

    public function asignarTablaClienteAction() {
        
    }

    public function nuevaTablaAction() {
        
    }

    public function nuevaSesionAction() {
        
    }

    public function nuevoEjercicioAction() {
        
    }

    public function nuevoEmpleadoAction() {
        
    }

    public function gestionarEmpleadosAction() {
        
    }

    public function buscarClienteAction() {
        
    }

}
