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
        // Buscar todos los clientes
//         $em = $this->getDoctrine()->getEntityManager();
//         $consultaClientes = "select c from MOTOPrincipalBundle:Cliente c";
//         $queryClientes = $em->createQuery($consultaClientes);
//         $clientes = $queryClientes->getResult();
//         
//         // Hacer un array con los DNI de los clientes
//         $arrayClientes = array();
//         foreach($clientes as $cliente){
//             array_push($arrayClientes, $cliente->getDni());
//         }
        
        // Buscar todas las dietas
         //$consultaDietas = "select d from MOTOPrincipalBundle:Dieta d";
         //$queryDietas = $em->createQuery($consultaDietas);
         //$dietas = $queryClientes->getResult();
        
        // Hacer formulario con dos desplegables
        $formClientes = $this->createFormBuilder()
                ->add('cliente', EntityType::class, array(
                    'placeholder' => 'Seleccionar cliente',
                    'choices' => $arrayClientes
                ))->getForm();
        
        return $this->render('MOTOPrincipalBundle:Administracion:asignarDieta.html.twig', array('form'=>$formClientes->createView()));
        
        // Asignar dieta
        
        
    }

    // MIGUEL
    public function crearDietaAction() {
        
    }

    // MIGUEL
    public function verDietaAction() {
        // Recuperar dietas
        $em = $this->getDoctrine()->getManager();
//        $consultaDietas = "select d from MOTOPrincipalBundle:Dieta d";
//        $queryDietas = $em->createQuery($consultaDietas);
//        $dietas = $queryDietas->getResult(Query::HYDRATE_ARRAY);
        
        // Mostrar desplegable con dietas
        /*$formDietas = $this->createFormBuilder()
                ->add('opciones', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array(
                    'choices' => array(
                        'si' => true,
                        'no' => false,
                    ),
                ))->getForm();
        
        return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('form'=>$formDietas));*/
        
        $form = $this->createFormBuilder()
                ->add('Codigo', 'text')
                ->getForm();
        
        $peticion = $this->getRequest();

        if ($peticion->getMethod() == 'POST'){
            $form->bind($peticion);
            $dietaSelec = $form->get("Codigo")->getData();
            
            // Comprobar si existe y sacar los datos
            $consultaDietaBuscada = "select d from MOTOPrincipalBundle:Dieta d";
            $queryDietaBuscada = $em->createQuery($consultaDietaBuscada);
            $dietaBuscada = $queryDietaBuscada->getResult();
            
            $diaDietaBuscada = "-";
            
            foreach($dietaBuscada as $dietaB){
                if($dietaB->getCoddieta() == $dietaSelec){
                    $diaDietaBuscada = $dietaB->getCoddia();
                }
            }
            
            
            
//            if($dietaBuscada != null){
//                $diaDietaBuscada = $dietaBuscada->getCoddia();
//                
//            }
            
            return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('dietaMostrar'=>$diaDietaBuscada));
            
            // Mostrar los datos por pantalla
        }
        
         return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array('form'=>$form->createView()));
        
        // Mostrar la que el usuario elija
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
