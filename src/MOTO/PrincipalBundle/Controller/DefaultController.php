<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    // Página de inicio
    public function indexAction() {
        session_start();
        
        $preparadores = array();

        if (isset($_SESSION['debug'])) {
            echo '<script>';
            echo "console.log('" . $_SESSION['debug'] . "')";
            echo '</script>';
        }
        // BOTONES CLIENTE
        $botonProgreso = "";
        $botonDietas = "";
        $botonAmpliarPlan = "";

        // BOTONES EMPLEADO
        $resumen = "-";
        $botonResumen = "-";
        $botonAdmin = "";

        // BOTONES DE LOGIN Y SIGNUP
        $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
        $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";

        $botonTablas = "";

        $botonLogout = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Logout'>Logout</a>";

        // Preparador y mail
        $preparadorAsignado = "";
        $mailRegistrado = "";


//        if(isset($_POST['user']) && isset($_POST['pwd'])){
//            if($_SESSION['resLogin'] == "cliente" || $_SESSION['resLogin'] == "empleado"){
//                $botonLogin = "-";
//                
//                // Coger el plan del usuario
//                $plan = "pro"; // PARA PROBAR, cambiar con lo de verdad
//
//                if($plan != null && ($plan == "pro" || $plan == "entrenamiento")){
//                    $linktabla = "<a class='navbar-brand' href='#'>Tabla de ejercicios</a>"; // PARA PROBAR, cambiar con lo de verdad
//                }
//                else{
//                    $linktabla = "";
//                }
//
//                if($_SESSION['resLogin'] == "cliente"){
//                    $botonProgreso = "<a class='navbar-brand' href='progreso.php'>Progreso</a>";
//                    $botonDietas = "<a class='navbar-brand' href='dietas.php'>Dietas</a>";
//                    $botonAmpliarPlan = "<a class='navbar-brand' href='ampliarplan.php'>Ampliar plan</a>";
//                }
//
//                if($_SESSION['resLogin'] == "empleado"){
//                    $resumen = "de mis clientes";
//                    $botonAdmin = "<a class='navbar-brand' href='admin.php'>Administracion</a>";
//                }
//
//                // Botón resumen está en empleado y cliente
//                $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen $resumen</a>";
//            } else 
        if (isset($_SESSION['dni'])) {

            $botonLogin = "-";

            if ($_SESSION['resLogin'] == "cliente" || $_SESSION['resLogin'] == "empleado") {

                // Coger el plan del usuario

                if ($_SESSION['resLogin'] == "cliente") {
                    $dni = $_SESSION['dni'];
                    $em = $this->getDoctrine()->getEntityManager();
                    $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $dni;
                    $queryCliente = $em->createQuery($consultaCliente);
                    $cliente = $queryCliente->getResult();
                    $plan = strtolower($cliente[0]->getCodplan()->getTipoplan());
                    
                    $preparadores = $cliente[0]->getNumeroempleado();
                } else {
                    $plan = null;
                }
                $resumen = ""; //Para evitar fallos

                if ($plan != null && ($plan == "pro" || $plan == "entrenamiento")) {
                    $botonTablas = "<a class='navbar-brand' href='tablas.php'>Tabla de ejercicios</a>";
                }

                if ($_SESSION['resLogin'] == "cliente") {
                    $botonProgreso = "<a class='navbar-brand' href='progreso.php'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='dietas.php'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='ampliarplan.php'>Ampliar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='admin.php'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen $resumen</a>";
            }
        } else {
            $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
            $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";
        }
//        }

        if (isset($_SESSION['dni'])) {
            if ($_SESSION['resLogin'] == "cliente") {
                // Buscar preparador y devolverlo
            }
        }

        // Meter todos los botones no nulos en un array de strings
        $arrayBotones = array(
            "botonProgreso" => $botonProgreso,
            "botonLogin" => $botonLogin,
            "botonDietas" => $botonDietas,
            "botonAmpliarPlan" => $botonAmpliarPlan,
            "botonAdmin" => $botonAdmin,
            "botonSignUp" => $botonSignUp,
            "botonTablas" => $botonTablas,
            "botonResumen" => $botonResumen,
            "botonLogout" => $botonLogout
        );

        // HACER PREPARADORES FÍSICOS

        return $this->render('MOTOPrincipalBundle:Default:index.html.twig', array("botones" => $arrayBotones, "preparadores" => $preparadores));
    }

}
