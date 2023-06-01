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

/* gift.new.categorie.twig */
class __TwigTemplate_32a3389cd2b79c04463def5efbf51502 extends Template
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
        $this->parent = $this->loadTemplate("gift.main.twig", "gift.new.categorie.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Création de categorie";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <form method=\"post\">
        <div>
            <label for=\"id\">Libelle</label>
            <input type=\"text\" name=\"libelle\" id=\"libelle\">
        </div>
        <div>
            <label for=\"id\">Description</label>
            <input type=\"text\" name=\"description\" id=\"description\">
        </div>
        <input type=\"hidden\" name=\"csrf\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["csrf"] ?? null), "html", null, true);
        echo "\">
        <input type=\"submit\" value=\"Envoyer\">
    </form>
";
    }

    public function getTemplateName()
    {
        return "gift.new.categorie.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 15,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "gift.new.categorie.twig", "C:\\xampp\\htdocs\\Dev\\gift\\gift.appli\\src\\views\\gift.new.categorie.twig");
    }
}
