<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdministracionController extends Controller {

    public function principalAdministracionAction() {
        session_start();
        if ($_SESSION['resLogin'] == "empleado") {

            $em = $this->getDoctrine()->getEntityManager();
            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $_SESSION['dni'];
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $empleados = $queryEmpleado->getResult();

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

    // MIGUEL
    public function asignarDietaAction() {
        // Hacer formulario con dos desplegables
        $formClientes = $this->createFormBuilder()
                ->add('cliente', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Cliente'
                ))
                ->add('dieta', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Dieta'
                ))
                ->getForm();
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $formClientes->bind($request);


            if ($formClientes->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                
                $cliSelect = $formClientes->get("cliente")->getData();
                $dietSelect = $formClientes->get("dieta")->getData();

                $cliSelect->setCoddieta($dietSelect);

                $em->persist($cliSelect);
                $em->flush();

                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:asignarDieta.html.twig', array('form' => $formClientes->createView(), 'error' => '-'));
    }

    // MIGUEL
    public function crearDietaAction() {

        // La nueva dieta tiene nombre, codigo,
    }

    // MIGUEL
    public function verDietaAction() {
        // Recuperar dietas
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
                ->add('Codigo', 'text')
                ->getForm();

        $peticion = $this->getRequest();

        if ($peticion->getMethod() == 'POST') {
            $form->bind($peticion);
            $dietaSelec = $form->get("Codigo")->getData();

            // Comprobar si existe y sacar los datos
            $consultaDietaBuscada = "select d from MOTOPrincipalBundle:Dieta d where d.coddieta=" . $dietaSelec;
            $queryDietaBuscada = $em->createQuery($consultaDietaBuscada);
            $dietaBuscada = $queryDietaBuscada->getResult();

            $diaDietaBuscada = "-";

            if ($dietaBuscada[0] != null) {
                $diaDietaBuscada = $dietaBuscada[0]->getCoddia();
            } else {
                return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('dietaMostrar' => 'Dieta no encontrada'));
            }


            return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('dietaMostrar' => $diaDietaBuscada[0]));
        }

        return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('form' => $form->createView()));
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
