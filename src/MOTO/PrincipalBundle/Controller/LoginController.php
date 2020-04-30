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

            // COMRPOBAR SI EL USURIO Y CLAVE SON CORRECTOS Y SI ES EMPLEADO O CLIENTE


            foreach ($empleados as $empleado) {
                if ($empleado->getNumeroempleado() == $usuario) {
                    if ($empleado->getClave() == $contra) {
                        //Almacenar datos de que login correcto en la sesion


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
            return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array('form' => $form->createView(), 'errores' => 'Usuario o contraseña incorrectos'));
        }

        return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array('form' => $form->createView(), 'errores' => '-'));
    }

    public function LogoutAction() {
        // Deshacer login
        return $this->render('MOTOPrincipalBundle:Login:Logout.html.twig', array());
    }

    public function SignUpAction() {

        $request = $this->getRequest();

        $cliente = new Cliente();
        $form = $this->createForm(new ClienteType(), $cliente);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($cliente);
                $em->flush();
                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }


        return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form' => $form->createView(),));
    }

}
