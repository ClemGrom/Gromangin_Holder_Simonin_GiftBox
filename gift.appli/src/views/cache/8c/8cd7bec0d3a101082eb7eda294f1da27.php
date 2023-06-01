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

/* gift.prestations.all.twig */
class __TwigTemplate_abd9570cc51e9d76e6a8b205ed60fdc7 extends Template
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
        $this->parent = $this->loadTemplate("gift.main.twig", "gift.prestations.all.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Prestations";
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
        foreach ($context['_seq'] as $context["_key"] => $context["presta"]) {
            // line 8
            echo "        <h1>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["presta"], "libelle", [], "any", false, false, false, 8), "html", null, true);
            echo "</h1>
        <p>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["presta"], "description", [], "any", false, false, false, 9), "html", null, true);
            echo "</p>
        <p>";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["presta"], "tarif", [], "any", false, false, false, 10), "html", null, true);
            echo "</p>
        <p>";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["presta"], "unite", [], "any", false, false, false, 11), "html", null, true);
            echo "</p>
        <p>";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["presta"], "id", [], "any", false, false, false, 12), "html", null, true);
            echo "</p>
        <li><a href=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestation", [], ["id" => twig_get_attribute($this->env, $this->source, $context["presta"], "id", [], "any", false, false, false, 13)]), "html", null, true);
            echo "\">Lien vers la prestation</a></li>
        <p>----------------</p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['presta'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "gift.prestations.all.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 13,  82 => 12,  78 => 11,  74 => 10,  70 => 9,  65 => 8,  61 => 7,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.prestations.all.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.prestations.all.twig");
    }
}
