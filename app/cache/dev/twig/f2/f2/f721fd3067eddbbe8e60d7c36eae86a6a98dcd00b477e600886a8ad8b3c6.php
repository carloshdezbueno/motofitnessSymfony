<?php

/* MOTOPrincipalBundle:Login:SignUp.html.twig */
class __TwigTemplate_f2f2f721fd3067eddbbe8e60d7c36eae86a6a98dcd00b477e600886a8ad8b3c6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<form action =\"";
        echo $this->env->getExtension('routing')->getPath("_signup");
        echo "\" method=\"post\">
  
    ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
    <input type=\"submit\"/>
</form>";
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
        return array (  25 => 4,  19 => 2,);
    }
}
