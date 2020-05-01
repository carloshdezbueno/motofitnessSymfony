<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller
{
    public function principalAdministracionAction()
    {
        $nota = "-";
        // Comprobar que el usuario logueado puede entrar aquí
        
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
