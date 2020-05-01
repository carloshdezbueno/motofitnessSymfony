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
            echo "                ";
            // line 10
            echo "                ";
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogin");
            echo "
                ";
            // line 11
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonSignUp");
            echo "
            ";
        } else {
            // line 13
            echo "                ";
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
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonAdmin");
            echo "
                ";
            // line 20
            echo $this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogout");
            echo "
                
            ";
        }
        // line 23
        echo "        </nav>
        <br>
        <br>
        <div class=\"row\">
            ";
        // line 27
        if ((($this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonLogin") == "-") && ($this->getAttribute((isset($context["botones"]) ? $context["botones"] : $this->getContext($context, "botones")), "botonAdmin") == ""))) {
            // line 28
            echo "                <h4 class=\"font-weight-light col-sm-12 col-12\">Preparador(es):</h4>
                ";
            // line 29
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["preparadores"]) ? $context["preparadores"] : $this->getContext($context, "preparadores")));
            foreach ($context['_seq'] as $context["_key"] => $context["preparador"]) {
                // line 30
                echo "                    <div class=\"card\" style=\"width: 18rem; margin-left: 5px\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preparador"]) ? $context["preparador"] : $this->getContext($context, "preparador")), "nombre"), "html", null, true);
                echo "</h5>
                            <h6 class=\"card-subtitle mb-2 text-muted\">Empleado nº: ";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preparador"]) ? $context["preparador"] : $this->getContext($context, "preparador")), "numeroempleado"), "html", null, true);
                echo "</h6>
                            <p class=\"card-text\">Email: ";
                // line 34
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preparador"]) ? $context["preparador"] : $this->getContext($context, "preparador")), "email"), "html", null, true);
                echo "</p>
                            <p class=\"card-text\">Telefono: ";
                // line 35
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["preparador"]) ? $context["preparador"] : $this->getContext($context, "preparador")), "telefono"), "html", null, true);
                echo "</p>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['preparador'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "            ";
        }
        // line 40
        echo "        </div>

        <img src=\"";
        // line 42
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
        return array (  127 => 40,  124 => 39,  114 => 35,  110 => 34,  77 => 20,  58 => 20,  53 => 18,  81 => 23,  76 => 22,  65 => 17,  23 => 1,  480 => 162,  474 => 161,  469 => 158,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 148,  437 => 147,  435 => 146,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 131,  402 => 130,  398 => 129,  393 => 126,  387 => 122,  384 => 121,  381 => 120,  379 => 119,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 99,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 86,  268 => 85,  264 => 84,  258 => 81,  252 => 80,  247 => 78,  241 => 77,  229 => 73,  220 => 70,  214 => 69,  177 => 65,  169 => 60,  140 => 55,  132 => 51,  128 => 49,  107 => 36,  61 => 16,  273 => 96,  269 => 94,  254 => 92,  243 => 88,  240 => 86,  238 => 85,  235 => 74,  230 => 82,  227 => 81,  224 => 71,  221 => 77,  219 => 76,  217 => 75,  208 => 68,  204 => 72,  179 => 69,  159 => 61,  143 => 56,  135 => 53,  119 => 42,  102 => 32,  71 => 28,  67 => 15,  63 => 15,  59 => 24,  38 => 9,  94 => 29,  89 => 27,  85 => 35,  75 => 17,  68 => 14,  56 => 19,  87 => 25,  21 => 2,  26 => 6,  93 => 28,  88 => 6,  78 => 21,  46 => 13,  27 => 4,  44 => 12,  31 => 5,  28 => 4,  201 => 92,  196 => 90,  183 => 82,  171 => 61,  166 => 71,  163 => 62,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 54,  136 => 56,  121 => 46,  117 => 44,  105 => 40,  91 => 28,  62 => 23,  49 => 19,  24 => 4,  25 => 3,  19 => 1,  79 => 18,  72 => 16,  69 => 18,  47 => 9,  40 => 10,  37 => 7,  22 => 2,  246 => 90,  157 => 56,  145 => 46,  139 => 45,  131 => 42,  123 => 47,  120 => 40,  115 => 43,  111 => 37,  108 => 36,  101 => 32,  98 => 30,  96 => 31,  83 => 23,  74 => 14,  66 => 26,  55 => 15,  52 => 14,  50 => 13,  43 => 8,  41 => 7,  35 => 5,  32 => 4,  29 => 3,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 84,  182 => 66,  176 => 64,  173 => 65,  168 => 72,  164 => 59,  162 => 57,  154 => 58,  149 => 51,  147 => 58,  144 => 49,  141 => 48,  133 => 55,  130 => 41,  125 => 44,  122 => 43,  116 => 41,  112 => 42,  109 => 34,  106 => 33,  103 => 32,  99 => 31,  95 => 28,  92 => 21,  86 => 28,  82 => 22,  80 => 33,  73 => 19,  64 => 17,  60 => 6,  57 => 15,  54 => 22,  51 => 14,  48 => 13,  45 => 11,  42 => 7,  39 => 9,  36 => 8,  33 => 6,  30 => 7,);
    }
}
