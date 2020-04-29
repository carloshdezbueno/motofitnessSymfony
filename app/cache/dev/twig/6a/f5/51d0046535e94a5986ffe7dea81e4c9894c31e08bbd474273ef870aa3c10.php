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
        <form action =\"";
        // line 7
        echo $this->env->getExtension('routing')->getPath("_login");
        echo "\" method=\"post\">

            ";
        // line 9
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
            <input type=\"submit\"/>
        </form>
    </div>
            
            ";
        // line 14
        if (((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")) != null)) {
            // line 15
            echo "                <p>";
            echo twig_escape_filter($this->env, (isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "html", null, true);
            echo twig_escape_filter($this->env, (isset($context["contra"]) ? $context["contra"] : $this->getContext($context, "contra")), "html", null, true);
            echo "</p>
            ";
        }
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
        return array (  56 => 15,  54 => 14,  46 => 9,  41 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
