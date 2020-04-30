<?php

/* MOTOPrincipalBundle:Login:SignUp.html.twig */
class __TwigTemplate_f2f2f721fd3067eddbbe8e60d7c36eae86a6a98dcd00b477e600886a8ad8b3c6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"container\">
        <nav class='navbar navbar-light bg-light row'>

            <a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>
            <a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>
        </nav>
        <br>
        <form action =\"";
        // line 11
        echo $this->env->getExtension('routing')->getPath("_signup");
        echo "\" method=\"post\">

            ";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            <button type=\"submit\" class=\"btn btn-primary\">Registrarse</button>



        </form>
        <br>
        ";
        // line 20
        if (((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")) != "-")) {
            // line 21
            echo "            <div class=\"alert alert-danger\" role=\"alert\">
                <p>";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
            echo "</p>
            </div>
        ";
        }
        // line 25
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MOTOPrincipalBundle:Login:SignUp.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 25,  60 => 22,  57 => 21,  55 => 20,  45 => 13,  40 => 11,  31 => 4,  28 => 3,);
    }
}
