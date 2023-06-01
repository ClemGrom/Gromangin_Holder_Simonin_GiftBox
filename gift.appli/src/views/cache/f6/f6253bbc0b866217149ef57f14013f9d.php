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

/* gift.header.twig */
class __TwigTemplate_f46a60a79d973ff46b09575b3b80d4e5 extends Template
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
        echo "/css/header-style.css\" >
</head>

<body>
    <div id=\"header\">
        <p>GiftBox</p>
        <p>Tu souhaites offrir une box ?</p>
    </div>
</body>";
    }

    public function getTemplateName()
    {
        return "gift.header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.header.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.header.twig");
    }
}
