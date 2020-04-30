<?php

/* MOTOPrincipalBundle:Login:Login.html.twig */
class __TwigTemplate_6af551d0046535e94a5986ffe7dea81e4c9894c31e08bbd474273ef870aa3c10 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        echo "MOTOPrincipalBundle:Login:Login";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">
        <nav class='navbar navbar-light bg-light row'>
            
            <a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Login'>LogIn</a>
            <a class='navbar-brand' href='/motofitnessSymfony/web/app_dev.php/Signup'>SignUp</a>
        </nav>
        <br>
        <form action =\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("_login");
        echo "\" method=\"post\">

            ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            <input type=\"submit\" value=\"Iniciar sesion\"/>
        </form>
        ";
        // line 18
        if (((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")) != "-")) {
            // line 19
            echo "            <div class=\"alert alert-danger\" role=\"alert\">
                <p>";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
            echo "</p>
            </div>
        ";
        }
        // line 23
        echo "    </div>


";
    }

    public function getTemplateName()
    {
        return "MOTOPrincipalBundle:Login:Login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 23,  63 => 20,  60 => 19,  58 => 18,  52 => 15,  47 => 13,  38 => 6,  35 => 5,  29 => 3,);
    }
}
