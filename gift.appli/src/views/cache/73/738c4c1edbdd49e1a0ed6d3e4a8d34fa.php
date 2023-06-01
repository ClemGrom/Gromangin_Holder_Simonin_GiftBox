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

/* gift.main.twig */
class __TwigTemplate_80a88e9d6b649f8e0694c1029bc3e9e8 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html lang=\"fr\">

<head>
    <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta charset=\"utf-8\">
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/css/main-style.css\" >
</head>

<body>
    <div class=\"main\">
        <div class=\"header\">";
        // line 11
        $this->loadTemplate("gift.header.twig", "gift.main.twig", 11)->display($context);
        echo "</div>
        <div class=\"nav\">";
        // line 12
        $this->loadTemplate("gift.nav.twig", "gift.main.twig", 12)->display($context);
        echo "</div>
        <div class=\"content\">";
        // line 13
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
        <div class=\"footer\">";
        // line 14
        $this->loadTemplate("gift.footer.twig", "gift.main.twig", 14)->display($context);
        echo "</div>
    </div>
</body>";
    }

    // line 4
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 13
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "gift.main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 13,  76 => 4,  69 => 14,  65 => 13,  61 => 12,  57 => 11,  49 => 6,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.main.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.main.twig");
    }
}
