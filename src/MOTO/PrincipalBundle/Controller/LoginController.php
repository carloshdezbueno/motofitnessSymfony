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

        $request = $this->getRequest();

        $cliente = new Cliente();
        $form = $this->createForm(new ClienteType(), $cliente);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();

                //Recuperas todos los empleados
//                $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e";
//                $queryEmpleado = $em->createQuery($consultaEmpleado);
//                $empleados = $queryEmpleado->getResult();
//
//                $numeroempleado = "";
//                $antit = 99999999999999999999;
//
//                foreach ($empleados as $empleado) {
//                    //Consultas la logitud de sus clientes asociados
//                    $long = $empleado->getDni()->count(); //Provisional
//                    
//                    if ($long < $antit) {
//
//                        $numeroempleado = $empleado->getNumeroempleado();
//                        $antit = $long;
//                    }
//                }


                $em->persist($cliente);
                $em->flush();
                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }


        return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(),));
    }

}
