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

/* gift.prestation.categorie.twig */
class __TwigTemplate_951bd2137a3db4045e0a623747657d3b extends Template
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
        $this->parent = $this->loadTemplate("gift.main.twig", "gift.prestation.categorie.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Categorie ";
        echo twig_escape_filter($this->env, ($context["categ_id"] ?? null), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <h1>Prestations</h1>
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["prestations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["prestation"]) {
            // line 8
            echo "        <p>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["prestation"], "id", [], "any", false, false, false, 8), "html", null, true);
            echo "</p>
        <p>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["prestation"], "libelle", [], "any", false, false, false, 9), "html", null, true);
            echo "</p>
        <p>";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["prestation"], "description", [], "any", false, false, false, 10), "html", null, true);
            echo "</p>
        <p>";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["prestation"], "tarif", [], "any", false, false, false, 11), "html", null, true);
            echo "</p>
        <p>";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["prestation"], "unite", [], "any", false, false, false, 12), "html", null, true);
            echo "</p>
        <a href=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestation", [], ["id" => twig_get_attribute($this->env, $this->source, $context["prestation"], "id", [], "any", false, false, false, 13)]), "html", null, true);
            echo "\">Lien vers la prestation</a>
        <p>----------------------</p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prestation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "gift.prestation.categorie.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 13,  83 => 12,  79 => 11,  75 => 10,  71 => 9,  66 => 8,  62 => 7,  59 => 6,  55 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.prestation.categorie.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.prestation.categorie.twig");
    }
}
