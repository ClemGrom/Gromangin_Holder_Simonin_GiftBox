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

/* gift.categorie.id.twig */
class __TwigTemplate_e194e15bdd3d5adea43c1be679e6fb7b extends Template
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
        $this->parent = $this->loadTemplate("gift.main.twig", "gift.categorie.id.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Categorie ";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <h1>Categorie ";
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "</h1>
    <p>";
        // line 7
        echo twig_escape_filter($this->env, ($context["libelle"] ?? null), "html", null, true);
        echo "</p>
    <p>";
        // line 8
        echo twig_escape_filter($this->env, ($context["description"] ?? null), "html", null, true);
        echo "</p>
    <a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categorieToPresta", ["id" => ($context["id"] ?? null)]), "html", null, true);
        echo "\">Prestations</a>
";
    }

    public function getTemplateName()
    {
        return "gift.categorie.id.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 9,  68 => 8,  64 => 7,  59 => 6,  55 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.categorie.id.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.categorie.id.twig");
    }
}
