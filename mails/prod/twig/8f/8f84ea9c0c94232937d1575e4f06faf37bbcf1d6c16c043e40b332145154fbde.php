<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @PrestaShop/Admin/Common/Grid/Columns/Content/bulk_action.html.twig */
class __TwigTemplate_bf3e6c3608971bed84527a0b3bb1a0ce19042c3a24aa6e2b962dc8e9ced38841 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "
<div class=\"md-checkbox\">
  <label>
    <input type=\"checkbox\"
           title=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute(($context["column"] ?? null), "name", []), "html", null, true);
        echo "\"
           class=\"js-bulk-action-checkbox\"
           name=\"";
        // line 31
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["grid"] ?? null), "id", []) . "_") . $this->getAttribute(($context["column"] ?? null), "id", [])), "html", null, true);
        echo "[]\"
           value=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["record"] ?? null), $this->getAttribute($this->getAttribute(($context["column"] ?? null), "options", []), "bulk_field", []), [], "array"), "html", null, true);
        echo "\"
    >
    <i class=\"md-checkbox-control\"></i>
  </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Common/Grid/Columns/Content/bulk_action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 32,  41 => 31,  36 => 29,  30 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Common/Grid/Columns/Content/bulk_action.html.twig", "/htdocs/prestarecup/src/PrestaShopBundle/Resources/views/Admin/Common/Grid/Columns/Content/bulk_action.html.twig");
    }
}
