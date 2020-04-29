<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MOTO\PrincipalBundle\Form\ClienteType;
use MOTO\PrincipalBundle\Entity\Cliente;

class LoginController extends Controller {

    public function LoginAction() {
        // Ir a la página de login
        return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array());
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
                
                $em=$this->getDoctrine()->getEntityManager();
                 $em->persist($cliente);
                 $em->flush();
                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }

echo '<script>';
                echo "console.log('Que ha entrao')";
                echo '</script>';
        return $this->render('MOTOPrincipalBundle:Login:SignUp.html.twig', array('form'=>$form->createView(),));
    }

}
