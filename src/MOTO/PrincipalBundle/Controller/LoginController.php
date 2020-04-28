<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function LoginAction()
    {
        // Ir a la página de login
        return $this->render('MOTOPrincipalBundle:Login:Login.html.twig', array());
    }

    public function LogoutAction()
    {
        // Deshacer login
        return $this->render('MOTOPrincipalBundle:Login:Logout.html.twig', array());
    }

}
