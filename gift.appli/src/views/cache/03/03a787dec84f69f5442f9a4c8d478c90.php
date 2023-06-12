<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* gift.nav.twig */
class __TwigTemplate_67423d00fb2b4ab78c690a5dbead8cff extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html lang=\"fr\">

<head>
    <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/css/nav-style.css\" >
</head>

<body>
<div id=\"nav\">
    <a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categorie"), "html", null, true);
        echo "\">GiftBox</a>
    <a href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categorie"), "html", null, true);
        echo "\">Categories</a>
    <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestations"), "html", null, true);
        echo "\">Prestations</a>
</div>
</body>";
    }

    public function getTemplateName()
    {
        return "gift.nav.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 11,  54 => 10,  50 => 9,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.nav.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.nav.twig");
    }
}
