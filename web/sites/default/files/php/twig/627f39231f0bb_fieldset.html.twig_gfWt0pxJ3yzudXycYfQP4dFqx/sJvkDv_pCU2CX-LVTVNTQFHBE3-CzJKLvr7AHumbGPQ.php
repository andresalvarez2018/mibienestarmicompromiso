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

/* themes/contrib/gin/templates/form/fieldset.html.twig */
class __TwigTemplate_10cb7ef2f401f5398c6b0bd0519a865d751bec1f62005d365c544b112c905fa4 extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 11
        $context["classes"] = [0 => "fieldset", 1 => ((twig_get_attribute($this->env, $this->source,         // line 13
($context["attributes"] ?? null), "hasClass", [0 => "fieldgroup"], "method", false, false, true, 13)) ? ("fieldset--group") : ("")), 2 => "js-form-item", 3 => "form-item", 4 => "js-form-wrapper", 5 => "form-wrapper", 6 => ((        // line 18
($context["description_toggle"] ?? null)) ? ("help-icon__description-container") : (""))];
        // line 22
        $context["wrapper_classes"] = [0 => "fieldset__wrapper", 1 => ((twig_get_attribute($this->env, $this->source,         // line 24
($context["attributes"] ?? null), "hasClass", [0 => "fieldgroup"], "method", false, false, true, 24)) ? ("fieldset__wrapper--group") : (""))];
        // line 28
        $context["legend_span_classes"] = [0 => "fieldset__label", 1 => ((twig_get_attribute($this->env, $this->source,         // line 30
($context["attributes"] ?? null), "hasClass", [0 => "fieldgroup"], "method", false, false, true, 30)) ? ("fieldset__label--group") : ("")), 2 => ((        // line 31
($context["required"] ?? null)) ? ("js-form-required") : ("")), 3 => ((        // line 32
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 36
        $context["legend_classes"] = [0 => "fieldset__legend", 1 => (((twig_get_attribute($this->env, $this->source,         // line 38
($context["attributes"] ?? null), "hasClass", [0 => "fieldgroup"], "method", false, false, true, 38) &&  !twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "hasClass", [0 => "form-composite"], "method", false, false, true, 38))) ? ("fieldset__legend--group") : ("")), 2 => ((twig_get_attribute($this->env, $this->source,         // line 39
($context["attributes"] ?? null), "hasClass", [0 => "form-composite"], "method", false, false, true, 39)) ? ("fieldset__legend--composite") : ("")), 3 => (((        // line 40
($context["title_display"] ?? null) == "invisible")) ? ("fieldset__legend--invisible") : ("fieldset__legend--visible"))];
        // line 44
        $context["description_classes"] = [0 => "fieldset__description", 1 => (((        // line 46
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : (""))];
        // line 49
        echo "<fieldset";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 49), 49, $this->source), "html", null, true);
        echo ">
  ";
        // line 50
        if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 50) && ($context["description_toggle"] ?? null))) {
            // line 51
            echo "    <div class=\"help-icon\">
  ";
        }
        // line 53
        echo "  ";
        // line 54
        echo "  ";
        if (twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 54)) {
            // line 55
            echo "    <legend";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "attributes", [], "any", false, false, true, 55), "addClass", [0 => ($context["legend_classes"] ?? null)], "method", false, false, true, 55), 55, $this->source), "html", null, true);
            echo ">
      <span";
            // line 56
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["legend_span"] ?? null), "attributes", [], "any", false, false, true, 56), "addClass", [0 => ($context["legend_span_classes"] ?? null)], "method", false, false, true, 56), 56, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 56), 56, $this->source), "html", null, true);
            echo "</span>
    </legend>
  ";
        }
        // line 59
        echo "  ";
        if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 59) && ($context["description_toggle"] ?? null))) {
            // line 60
            echo "      ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gin/gin_description_toggle"), "html", null, true);
            echo "
      <button class=\"help-icon__description-toggle\"></button>
    </div>
    ";
            // line 63
            if (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 63)) {
                // line 64
                echo "      <div";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 64), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 64), 64, $this->source), "html", null, true);
                echo ">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
                echo "</div>
    ";
            }
            // line 66
            echo "  ";
        }
        // line 67
        echo "  <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => ($context["wrapper_classes"] ?? null)], "method", false, false, true, 67), 67, $this->source), "html", null, true);
        echo ">
    ";
        // line 68
        if (($context["inline_items"] ?? null)) {
            // line 69
            echo "    <div class=\"container-inline\">
      ";
        }
        // line 71
        echo "
      ";
        // line 72
        if (($context["prefix"] ?? null)) {
            // line 73
            echo "        <span class=\"fieldset__prefix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 73, $this->source), "html", null, true);
            echo "</span>
      ";
        }
        // line 75
        echo "      ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 75, $this->source), "html", null, true);
        echo "
      ";
        // line 76
        if (($context["suffix"] ?? null)) {
            // line 77
            echo "        <span class=\"fieldset__suffix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null), 77, $this->source), "html", null, true);
            echo "</span>
      ";
        }
        // line 79
        echo "      ";
        if (($context["errors"] ?? null)) {
            // line 80
            echo "        <div class=\"fieldset__error-message\">
          ";
            // line 81
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 81, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 84
        echo "      ";
        if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 84) &&  !($context["description_toggle"] ?? null))) {
            // line 85
            echo "        <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 85), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 85), 85, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
            echo "</div>
      ";
        }
        // line 87
        echo "
      ";
        // line 88
        if (($context["inline_items"] ?? null)) {
            // line 89
            echo "    </div>
    ";
        }
        // line 91
        echo "  </div>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/gin/templates/form/fieldset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 91,  174 => 89,  172 => 88,  169 => 87,  161 => 85,  158 => 84,  152 => 81,  149 => 80,  146 => 79,  140 => 77,  138 => 76,  133 => 75,  127 => 73,  125 => 72,  122 => 71,  118 => 69,  116 => 68,  111 => 67,  108 => 66,  100 => 64,  98 => 63,  91 => 60,  88 => 59,  80 => 56,  75 => 55,  72 => 54,  70 => 53,  66 => 51,  64 => 50,  59 => 49,  57 => 46,  56 => 44,  54 => 40,  53 => 39,  52 => 38,  51 => 36,  49 => 32,  48 => 31,  47 => 30,  46 => 28,  44 => 24,  43 => 22,  41 => 18,  40 => 13,  39 => 11,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/gin/templates/form/fieldset.html.twig", "/app/web/themes/contrib/gin/templates/form/fieldset.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 11, "if" => 50);
        static $filters = array("escape" => 49);
        static $functions = array("attach_library" => 60);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
