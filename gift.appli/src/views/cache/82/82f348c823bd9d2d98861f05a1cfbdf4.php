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

/* gift.prestation.twig */
class __TwigTemplate_ca2065cdb3014dc8205c134ff12c6343 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "gift.main.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("gift.main.twig", "gift.prestation.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Prestation ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "id", [], "any", false, false, false, 3), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <h1>Prestation ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "id", [], "any", false, false, false, 6), "html", null, true);
        echo "</h1>
    <h1>Prestation ";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "libelle", [], "any", false, false, false, 7), "html", null, true);
        echo "</h1>
    <p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "description", [], "any", false, false, false, 8), "html", null, true);
        echo "</p>
    <p>";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "tarif", [], "any", false, false, false, 9), "html", null, true);
        echo "</p>
    <p>";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["prestation"] ?? null), "unite", [], "any", false, false, false, 10), "html", null, true);
        echo "</p>
    <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestations"), "html", null, true);
        echo "\">Liste de prestations</a>
";
    }

    public function getTemplateName()
    {
        return "gift.prestation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 11,  76 => 10,  72 => 9,  68 => 8,  64 => 7,  59 => 6,  55 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.prestation.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.prestation.twig");
    }
}
