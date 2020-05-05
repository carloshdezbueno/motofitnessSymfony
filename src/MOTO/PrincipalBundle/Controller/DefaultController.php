<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MOTO\PrincipalBundle\Entity\Progreso;

class DefaultController extends Controller {

    // Página de inicio
    public function indexAction() {
        session_start();

        $preparadores = array();

        $request = $this->getRequest();
        $session = $request->getSession();

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
                    $botonTablas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verTabla'>Tabla de ejercicios</a>";
                }

                if ($_SESSION['resLogin'] == "cliente") {
                    $botonProgreso = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/insertProgreso'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Admin'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen $resumen</a>";
            }
        } else {
            $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
            $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";
        }

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

        $_SESSION['arrayBotones'] = $arrayBotones;

        // HACER PREPARADORES FÍSICOS

        return $this->render('MOTOPrincipalBundle:Default:index.html.twig', array("botones" => $arrayBotones, "preparadores" => $preparadores));
    }

    public function verDietaAction() {
        session_start();

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
                    $botonTablas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verTabla'>Tabla de ejercicios</a>";
                }

                if ($_SESSION['resLogin'] == "cliente") {
                    $botonProgreso = "<a class='navbar-brand' href='progreso.php'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Admin'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen $resumen</a>";
            }
        } else {
            $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
            $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";
        }

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

        //Recuperamos la dieta

        $em = $this->getDoctrine()->getEntityManager();
        $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $_SESSION['dni'];
        $queryCliente = $em->createQuery($consultaCliente);
        $clientes = $queryCliente->getResult();

        $dieta = $clientes[0]->getCoddieta();

        return $this->render('MOTOPrincipalBundle:Default:verDieta.html.twig', array("botones" => $arrayBotones, "dietaMostrar" => $dieta));
    }

    public function verTablaAction() {
        session_start();

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
                    $botonTablas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verTabla'>Tabla de ejercicios</a>";
                }

                if ($_SESSION['resLogin'] == "cliente") {
                    $botonProgreso = "<a class='navbar-brand' href='progreso.php'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Admin'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen $resumen</a>";
            }
        } else {
            $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
            $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";
        }

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

        //Recuperamos la dieta

        $em = $this->getDoctrine()->getEntityManager();
        $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $_SESSION['dni'];
        $queryCliente = $em->createQuery($consultaCliente);
        $clientes = $queryCliente->getResult();

        $tabla = $clientes[0]->getCodtabla();

        return $this->render('MOTOPrincipalBundle:Default:verTabla.html.twig', array("botones" => $arrayBotones, "tablaMostrar" => $tabla));
    }

    public function progresoAction() {

        $request = $this->getRequest();
        $session = $request->getSession();
        // BOTONES CLIENTE
        $botonProgreso = "";
        $botonDietas = "";
        $botonAmpliarPlan = "";
        $botonResumen = "-";

        $botonTablas = "";

        $botonLogout = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Logout'>Logout</a>";

        $botonLogin = "-";

        $em = $this->getDoctrine()->getEntityManager();
        $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $session->get('dni');
        $queryCliente = $em->createQuery($consultaCliente);
        $cliente = $queryCliente->getResult();
        $plan = strtolower($cliente[0]->getCodplan()->getTipoplan());


        if ($plan != null && ($plan == "pro" || $plan == "entrenamiento")) {
            $botonTablas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verTabla'>Tabla de ejercicios</a>";
        }

        $botonProgreso = "<a class='navbar-brand' href='progreso.php'>Progreso</a>";
        $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
        $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
        // Botón resumen está en empleado y cliente
        $botonResumen = "<a class='navbar-brand' href='resumen.php'>Resumen</a>";



        $arrayBotones = array(
            "botonProgreso" => $botonProgreso,
            "botonLogin" => $botonLogin,
            "botonDietas" => $botonDietas,
            "botonAmpliarPlan" => $botonAmpliarPlan,
            "botonTablas" => $botonTablas,
            "botonResumen" => $botonResumen,
            "botonLogout" => $botonLogout
        );

        $error = "-";


        $progreso = new Progreso();



        $form = $this->createFormBuilder()
                ->add('imagen', 'file', [
                    'required' => false])
                ->add('peso', 'number')
                ->add('medidas', 'text')
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);


            if ($form->isValid()) {



                $em = $this->getDoctrine()->getEntityManager();

                $progreso->setMedidas($form["medidas"]->getData());
                $progreso->setPeso($form["peso"]->getData());

                $file = $form['imagen']->getData();


                if ($file == null) {

                    $default = "/motofitnessSymfony/web/img/img.jpg";
                    $progreso->setImagen($default);
                } else {

                    $directory = "/motofitnessSymfony/web/img//";
                    $fileName = "prueba";
                    $extension = $file->guessExtension();
                    if ($extension != null) {


                        if ($extension != "png" && $extension != "jpg" && $extension != "jpeg") {
                            echo '<script>';
                            echo "console.log('excepcion')";
                            echo '</script>';
                            $error = "Extension del archivo no valida";
                        } else {

                            $fileName = time() . '.' . $extension;
                            echo '<script>';
                            echo "console.log('" . $fileName . "')";
                            echo '</script>';
                            
                            
                            $resultado = $file->move($directory, $fileName);
                            
                            echo '<script>';
                            echo "console.log('Movido----" . $resultado . "----')";
                            echo '</script>';
                            
                            $progreso->setImagen($directory . $fileName);
                        }
                    } else {
                        $default = "/motofitnessSymfony/web/img/img.jpg";
                        $progreso->setImagen($default);
                    }
                }




                $progreso->setDni($cliente[0]);


                echo '<script>';
                echo "console.log('" . $progreso . "')";
                echo '</script>';



                if ($error != "-") {

                    return $this->render('MOTOPrincipalBundle:Default:progreso.html.twig', array("botones" => $arrayBotones, 'form' => $form->createView(), 'error' => $error));
                }
            }

            //return $this->redirect($this->generateUrl('moto_principal_homepage'));
        }



        return $this->render('MOTOPrincipalBundle:Default:progreso.html.twig', array("botones" => $arrayBotones, 'form' => $form->createView(), 'error' => $error));
    }

}
