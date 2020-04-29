<?php

/* MOTOPrincipalBundle:Default:index.html.twig */
class __TwigTemplate_a3ef74901042d8ef183b5c8d0c7945d70ab6132e0a6695dd3c8fd363fc94449f extends Twig_Template
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

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "
    <div class=\"container\">
      <nav class='navbar navbar-light bg-light row'>
           ";
        // line 8
        if (($this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogin") != "-")) {
            // line 9
            echo "               ";
            // line 10
            echo "               ";
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogin");
            echo "
               ";
            // line 11
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonSignUp");
            echo "
           ";
        } else {
            // line 13
            echo "               ";
            // line 14
            echo "                ";
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonProgreso");
            echo "
                ";
            // line 15
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonResumen");
            echo "
                ";
            // line 16
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonDietas");
            echo "
                ";
            // line 17
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonTablas");
            echo "
                ";
            // line 18
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonAmpliarPlan");
            echo "
                ";
            // line 19
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogout");
            echo "
           ";
        }
        // line 21
        echo "      </nav>
       <br>
       <br>
       <div class=\"row\">
           ";
        // line 25
        if (($this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogin") == "-")) {
            // line 26
            echo "               ";
            // line 27
            echo "           ";
        }
        // line 28
        echo "       </div>
       
       <img src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("img/iconomoto.png"), "html", null, true);
        echo "\" alt=\"iconomoto\">
    </div>
           
";
    }

    public function getTemplateName()
    {
        return "MOTOPrincipalBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 30,  91 => 28,  88 => 27,  86 => 26,  84 => 25,  78 => 21,  73 => 19,  69 => 18,  65 => 17,  61 => 16,  57 => 15,  52 => 14,  50 => 13,  45 => 11,  40 => 10,  38 => 9,  36 => 8,  31 => 5,  28 => 4,);
    }
}
