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
                $botonResumen = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verResumenCliente'>Resumen $resumen</a>";
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
                    $botonProgreso = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/insertProgreso'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Admin'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verResumenCliente'>Resumen $resumen</a>";
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
                    $botonProgreso = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/insertProgreso'>Progreso</a>";
                    $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
                    $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
                }

                if ($_SESSION['resLogin'] == "empleado") {
                    $resumen = "de mis clientes";
                    $botonAdmin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Admin'>Administracion</a>";
                }

                // Botón resumen está en empleado y cliente
                $botonResumen = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verResumenCliente'>Resumen $resumen</a>";
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

    public function verResumenAction() {
        $em = $this->getDoctrine()->getEntityManager();
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
                $botonResumen = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verResumenCliente'>Resumen $resumen</a>";
            }
        } else {
            $botonLogin = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>";
            $botonSignUp = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>";
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


        if ($_SESSION['resLogin'] == "cliente") {
            $consultaResumen = "select p from MOTOPrincipalBundle:Progreso p where p.dni=" . $session->get('dni');
            $queryResumen = $em->createQuery($consultaResumen);
            $resumenCli = $queryResumen->getResult();

            $resumen = array($cliente[0]->getNombre() => $resumenCli);
        } else if ($_SESSION['resLogin'] == "empleado") {

            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $session->get('dni');
            
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $empleado = $queryEmpleado->getResult();
            
            $clientesEmp = $empleado[0]->getDni();
            $resumen = array();
            foreach ($clientesEmp as $cliente) {
                
                
                $consultaResumen = "select p from MOTOPrincipalBundle:Progreso p where p.dni=" . $cliente->getDni();
                $queryResumen = $em->createQuery($consultaResumen);
                $resumenCli = $queryResumen->getResult();
                echo '<script>';
                echo "console.log('Entra')";
                echo '</script>';
                $resumen[$cliente->getNombre()] = $resumenCli;
            }
        }

        return $this->render('MOTOPrincipalBundle:Default:verResumenCliente.html.twig', array("botones" => $arrayBotones, 'resumen' => $resumen));
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

        $botonProgreso = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/insertProgreso'>Progreso</a>";
        $botonDietas = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verDieta'>Dietas</a>";
        $botonAmpliarPlan = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/modificarPlan'>Modificar plan</a>";
        // Botón resumen está en empleado y cliente
        $botonResumen = "<a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/verResumenCliente'>Resumen</a>";



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

                    $directory = "img/";
                    $fileName = "prueba";
                    $extension = $file->guessExtension();
                    if ($extension != null) {


                        if ($extension != "png" && $extension != "jpg" && $extension != "jpeg") {
                            $error = "Extension del archivo no valida";
                        } else {

                            $fileName = time() . '.' . $extension;
                            try {
                                $file->move($directory, $fileName);
                            } catch (FileException $e) {
                                // ... handle exception if something happens during file upload
                                $error = "Error al enviar la imagen";
                            }

                            $progreso->setImagen($directory . $fileName);
                        }
                    } else {
                        $default = "/motofitnessSymfony/web/img/img.jpg";
                        $progreso->setImagen($default);
                    }
                }

                $progreso->setDni($cliente[0]);

                if ($error != "-") {

                    return $this->render('MOTOPrincipalBundle:Default:progreso.html.twig', array("botones" => $arrayBotones, 'form' => $form->createView(), 'error' => $error));
                } else {
                    $em->persist($progreso);
                    $em->flush();
                }
            }

            return $this->redirect($this->generateUrl('verResumenCliente'));
        }



        return $this->render('MOTOPrincipalBundle:Default:progreso.html.twig', array("botones" => $arrayBotones, 'form' => $form->createView(), 'error' => $error));
    }

}
