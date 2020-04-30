<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MOTO\PrincipalBundle\Form\ClienteType;
use MOTO\PrincipalBundle\Entity\Cliente;

class LoginController extends Controller {

    public function LoginAction() {
        // Ir a la página de login


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

                try {
                    
                    $em->persist($cliente);
                    $em->flush();
                    
                } catch (Exception $e) {
                    echo '<script>';
            echo "console.log('Entra')";
            echo '</script>';
                    $error = $e->getMessage();
                    return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
                }

                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }


        return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(), 'error' => $error));
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
