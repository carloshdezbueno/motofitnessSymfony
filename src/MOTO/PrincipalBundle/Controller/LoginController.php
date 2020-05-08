<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MOTO\PrincipalBundle\Form\ClienteType;
use MOTO\PrincipalBundle\Entity\Cliente;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller {

    public function LoginAction() {

        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createFormBuilder()
                ->add('Login', 'text')
                ->add('Clave', 'password')
                ->getForm();

        $peticion = $this->getRequest();

        if ($peticion->getMethod() == 'POST') {
            $form->bind($peticion);

            // Comprobar usuario y contraseña
            $usuario = $form->get("Login")->getData();
            $contra = $form->get("Clave")->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c";
            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e";
            $queryCliente = $em->createQuery($consultaCliente);
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $clientes = $queryCliente->getResult();
            $empleados = $queryEmpleado->getResult();

            foreach ($empleados as $empleado) {
                if ($empleado->getNumeroempleado() == $usuario) {
                    if ($empleado->getClave() == $contra) {
                        //Almacenar datos de que login correcto en la sesion
                        $_SESSION['dni'] = $usuario;
                        $_SESSION['resLogin'] = "empleado";
                        
                        $session->set('dni', $usuario);
                        $session->set('resLogin', "empleado");

                        return $this->redirect($this->generateUrl('moto_principal_homepage'));
                    }
                }
            }
            foreach ($clientes as $cliente) {
                if ($cliente->getDni() == $usuario) {
                    if ($cliente->getClave() == $contra) {
                        //Almacenar datos de que login correcto en la sesion
                        $_SESSION['dni'] = $usuario;
                        $_SESSION['resLogin'] = "cliente";
                        
                        $session->set('dni', $usuario);
                        $session->set('resLogin', "cliente");

                        return $this->redirect($this->generateUrl('moto_principal_homepage'));
                    }
                }
            }

            // Si usuario o clave incorrectos
            return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array('form' => $form->createView(), 'error' => 'Usuario o contraseña incorrectos'));
        }

        return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array('form' => $form->createView(), 'error' => '-'));
    }

    public function LogoutAction() {
        // Deshacer login
        session_start();
        session_destroy();
        return $this->redirect($this->generateUrl('moto_principal_homepage'));
    }

    public function SignUpAction() {

        $error = "-";
        $request = $this->getRequest();

        $cliente = new Cliente();
        $form = $this->createForm(new ClienteType(), $cliente);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);


            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();

                $passrep = $_POST['recpass'];
                
                //Asignacion de empleados
                if (strtolower($cliente->getCodplan()->getTipoplan()) === "nutricion") {
                    $preparador1 = $this->selectpreparador(1);
                }
                if (strtolower($cliente->getCodplan()->getTipoplan()) === "entrenamiento" || strtolower($cliente->getCodplan()->getTipoplan()) === "pro") {
                    $preparador1 = $this->selectpreparador(1);
                    $preparador2 = $this->selectpreparador(2);

                    if ($preparador1->getEspecialidad() == "3") {
                        unset($preparador2);
                    } else if ($preparador2->getEspecialidad() == "3" || $preparador2->getNumeroempleado() == $preparador1->getNumeroempleado()) {
                        $preparador1 = $preparador2;
                        unset($preparador2);
                    }
                }

                if (isset($preparador1)) {
                    $cliente->addNumeroempleado($preparador1);
                }

                if (isset($preparador2)) {
                    $cliente->addNumeroempleado($preparador2);
                }

                if($error != "-"){
                    return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
                }
                try {

                    $em->persist($cliente);
                    $em->flush();
                } catch (\Exception $e) {

                    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                        $error = "Error, el DNI ya existe";
                    }else{
                        $error = $e->getMessage();
                    }

                    return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
                }
                
                if($error != "-"){
                    return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
                }

                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }


        return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
    }

    public function modificarPlanAction() {

        $error = "-";
        $request = $this->getRequest();

        $form = $this->createFormBuilder()
                ->add('plan', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Plan'
                ))
                ->getForm();
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

        if ($request->getMethod() == 'POST') {
            $form->bind($request);


            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $_SESSION['dni'];
                $queryCliente = $em->createQuery($consultaCliente);
                $clientes = $queryCliente->getResult();

                $cliente = $clientes[0];

                $planAnt = $cliente->getCodplan();

                $planNuevo = $form->get("plan")->getData();

                $cliente->setCodplan($form->get("plan")->getData());

                if ($planAnt->getCodplan() == "1" && $planNuevo->getCodplan() != "1") {
                    $preparador2 = $this->selectpreparador(2);



                    if ($cliente->getNumeroempleado()[0]->getEspecialidad() == "3") {
                        unset($preparador2);
                    } else if ($cliente->getNumeroempleado()[0]->getEspecialidad() == "3" || $preparador2->getNumeroempleado() == $cliente->getNumeroempleado()[0]->getNumeroempleado()) {
                        unset($preparador2);
                    }
                }

                if (isset($preparador2)) {
                    $cliente->addNumeroempleado($preparador2);
                }

                if ($planAnt->getCodplan() != "1" && $planNuevo->getCodplan() == "1") {
                    foreach ($cliente->getNumeroempleado() as $empleado) {
                        if ($empleado->getEspecialidad() != "1" && $empleado->getEspecialidad() != "3") {
                            $cliente->removeNumeroempleado($empleado);
                        }
                        if ($empleado->getEspecialidad() == "3") {
                            $hayEsp3 = true;
                        }
                    }

                    if (isset($hayEsp3) && $hayEsp3) {
                        foreach ($cliente->getNumeroempleado() as $empleado) {
                            if ($empleado->getEspecialidad() != "3") {
                                $cliente->removeNumeroempleado($empleado);
                            }
                        }
                    }
                }

                try {

                    $em->persist($cliente);
                    $em->flush();
                } catch (\Exception $e) {
                    $error = "Error, el plan no se actualizo con exito";

                    return $this->render('MOTOPrincipalBundle:Login:ampliarPlan.html.twig', array('form' => $form->createView(), 'error' => $e->getMessage()));
                }

                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }
        return $this->render('MOTOPrincipalBundle:Login:ampliarPlan.html.twig', array("botones" => $arrayBotones, 'form' => $form->createView(), 'error' => $error));
    }

    private function selectpreparador($especialidad) {
        //Recuperas todos los empleados

        $em = $this->getDoctrine()->getEntityManager();
        $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.especialidad=" . $especialidad . " OR e.especialidad = '3'";
        $queryEmpleado = $em->createQuery($consultaEmpleado);
        $empleados = $queryEmpleado->getResult();

        $numeroempleado = "";
        $antit = 99999999999999999999;

        foreach ($empleados as $empleado) {
            //Consultas la logitud de sus clientes asociados
            $long = $empleado->getDni()->count(); //Provisional

            if ($long < $antit) {

                $numeroempleado = $empleado;
                $antit = $long;
            }
        }

        return $numeroempleado;
    }

}
