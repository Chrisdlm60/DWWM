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

/* @PrestaShop/Admin/Improve/Design/Cms/Blocks/form.html.twig */
class __TwigTemplate_fe86d6ba917fe0b1754266dcad3e1fd4812e0160f83d6fc8655dab6f9b8fccf1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'cms_page_form_rest' => [$this, 'block_cms_page_form_rest'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "
";
        // line 26
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/form.html.twig", 26)->unwrap();
        // line 27
        echo "
";
        // line 28
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["cmsPageForm"] ?? null), 'form_start');
        echo "
  <div class=\"card\">
    <div class=\"card-header\">
      ";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Page", [], "Admin.Shopparameters.Feature"), "html", null, true);
        echo "
    </div>
    <div class=\"card-block row\">
      <div class=\"card-text\">
        ";
        // line 35
        $this->displayBlock('cms_page_form_rest', $context, $blocks);
        // line 38
        echo "      </div>
    </div>

    <div class=\"card-footer\">
      <div class=\"d-inline-flex\">
        <a href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_cms_pages_index", ["id_cms_category" => ($context["cmsCategoryParentId"] ?? null)]), "html", null, true);
        echo "\" class=\"btn btn-outline-secondary\">
          ";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Cancel", [], "Admin.Actions"), "html", null, true);
        echo "
        </a>
      </div>

      <div class=\"d-inline-flex float-right\">
        <button type=\"submit\" class=\"btn btn-primary\" name=\"save-and-preview\">
        ";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save and preview", [], "Admin.Actions"), "html", null, true);
        echo "
      </button>

      <button type=\"submit\" class=\"btn btn-primary ml-3\">";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
    </div>
  </div>

</div>
";
        // line 58
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["cmsPageForm"] ?? null), 'form_end');
        echo "
";
    }

    // line 35
    public function block_cms_page_form_rest($context, array $blocks = [])
    {
        // line 36
        echo "          ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["cmsPageForm"] ?? null), 'rest');
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/Cms/Blocks/form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 36,  94 => 35,  88 => 58,  80 => 53,  74 => 50,  65 => 44,  61 => 43,  54 => 38,  52 => 35,  45 => 31,  39 => 28,  36 => 27,  34 => 26,  31 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Improve/Design/Cms/Blocks/form.html.twig", "/htdocs/prestarecup/src/PrestaShopBundle/Resources/views/Admin/Improve/Design/Cms/Blocks/form.html.twig");
    }
}
