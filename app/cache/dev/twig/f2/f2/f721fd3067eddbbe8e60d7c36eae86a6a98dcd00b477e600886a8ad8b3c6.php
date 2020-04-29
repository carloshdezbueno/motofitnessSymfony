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
    <form action =\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath("_signup");
        echo "\" method=\"post\">

        ";
        // line 7
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
        <input type=\"submit\"/>
    </form>
    </div>
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
        return array (  39 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
