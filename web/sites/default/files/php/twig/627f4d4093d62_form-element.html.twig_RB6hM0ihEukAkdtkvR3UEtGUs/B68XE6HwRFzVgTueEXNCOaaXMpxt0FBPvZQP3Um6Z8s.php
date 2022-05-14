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

/* themes/contrib/gin/templates/form/form-element.html.twig */
class __TwigTemplate_ee45abac093dfe707fbe7f0dbb0de009b0a087c4e26e600073a568d58cd108c9 extends \Twig\Template
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
        // line 14
        $context["classes"] = [0 => "js-form-item", 1 => "form-item", 2 => ("js-form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 17
($context["type"] ?? null), 17, $this->source))), 3 => ("form-type--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 18
($context["type"] ?? null), 18, $this->source))), 4 => ((twig_in_filter(        // line 19
($context["type"] ?? null), [0 => "checkbox", 1 => "radio"])) ? ("form-type--boolean") : ("")), 5 => ("js-form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 20
($context["name"] ?? null), 20, $this->source))), 6 => ("form-item--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 21
($context["name"] ?? null), 21, $this->source))), 7 => ((!twig_in_filter(        // line 22
($context["title_display"] ?? null), [0 => "after", 1 => "before"])) ? ("form-item--no-label") : ("")), 8 => (((        // line 23
($context["disabled"] ?? null) == "disabled")) ? ("form-item--disabled") : ("")), 9 => ((        // line 24
($context["errors"] ?? null)) ? ("form-item--error") : ("")), 10 => ((twig_get_attribute($this->env, $this->source,         // line 25
($context["description"] ?? null), "content", [], "any", false, false, true, 25)) ? ("help-icon__description-container") : (""))];
        // line 29
        $context["description_classes"] = [0 => "form-item__description", 1 => (((        // line 31
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : (""))];
        // line 34
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 34), 34, $this->source), "html", null, true);
        echo ">
  ";
        // line 35
        if (twig_in_filter(($context["label_display"] ?? null), [0 => "before", 1 => "invisible"])) {
            // line 36
            echo "    ";
            if (($context["description_toggle"] ?? null)) {
                // line 37
                echo "      <div class=\"help-icon\">
        ";
                // line 38
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 38, $this->source), "html", null, true);
                echo "
        ";
                // line 39
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gin/gin_description_toggle"), "html", null, true);
                echo "
        <button class=\"help-icon__description-toggle\"></button>
      </div>
    ";
            } else {
                // line 43
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 43, $this->source), "html", null, true);
                echo "
    ";
            }
            // line 45
            echo "  ";
        }
        // line 46
        echo "  ";
        if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 46) && ($context["description_toggle"] ?? null))) {
            // line 47
            echo "  <div class=\"help-icon__element-has-description\">
  ";
        }
        // line 49
        echo "  ";
        if ( !twig_test_empty(($context["prefix"] ?? null))) {
            // line 50
            echo "    <span class=\"form-item__prefix";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["disabled"] ?? null) == "disabled")) ? (" is-disabled") : ("")));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 50, $this->source), "html", null, true);
            echo "</span>
  ";
        }
        // line 52
        echo "  ";
        if (((($context["description_display"] ?? null) == "before") && twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 52))) {
            // line 53
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 53), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 53), 53, $this->source), "html", null, true);
            echo ">
      ";
            // line 54
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 54), 54, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 57
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 57, $this->source), "html", null, true);
        echo "
  ";
        // line 58
        if ( !twig_test_empty(($context["suffix"] ?? null))) {
            // line 59
            echo "    <span class=\"form-item__suffix";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($context["disabled"] ?? null) == "disabled")) ? (" is-disabled") : ("")));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null), 59, $this->source), "html", null, true);
            echo "</span>
  ";
        }
        // line 61
        echo "  ";
        if ((($context["label_display"] ?? null) == "after")) {
            // line 62
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 62) && ($context["description_toggle"] ?? null))) {
                // line 63
                echo "      <div class=\"help-icon\">
        ";
                // line 64
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 64, $this->source), "html", null, true);
                echo "
        ";
                // line 65
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gin/gin_description_toggle"), "html", null, true);
                echo "
        <button class=\"help-icon__description-toggle\"></button>
      </div>
    ";
            } else {
                // line 69
                echo "      ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 69, $this->source), "html", null, true);
                echo "
    ";
            }
            // line 71
            echo "  ";
        }
        // line 72
        echo "  ";
        if ((twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 72) && ($context["description_toggle"] ?? null))) {
            // line 73
            echo "  </div>
  ";
        }
        // line 75
        echo "  ";
        if (($context["errors"] ?? null)) {
            // line 76
            echo "    <div class=\"form-item__error-message\">
      ";
            // line 77
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 77, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 80
        echo "  ";
        if ((twig_in_filter(($context["description_display"] ?? null), [0 => "after", 1 => "invisible"]) && twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 80))) {
            // line 81
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 81), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 81), 81, $this->source), "html", null, true);
            echo ">
      ";
            // line 82
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 85
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/gin/templates/form/form-element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 85,  189 => 82,  184 => 81,  181 => 80,  175 => 77,  172 => 76,  169 => 75,  165 => 73,  162 => 72,  159 => 71,  153 => 69,  146 => 65,  142 => 64,  139 => 63,  136 => 62,  133 => 61,  125 => 59,  123 => 58,  118 => 57,  112 => 54,  107 => 53,  104 => 52,  96 => 50,  93 => 49,  89 => 47,  86 => 46,  83 => 45,  77 => 43,  70 => 39,  66 => 38,  63 => 37,  60 => 36,  58 => 35,  53 => 34,  51 => 31,  50 => 29,  48 => 25,  47 => 24,  46 => 23,  45 => 22,  44 => 21,  43 => 20,  42 => 19,  41 => 18,  40 => 17,  39 => 14,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/gin/templates/form/form-element.html.twig", "/app/web/themes/contrib/gin/templates/form/form-element.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 14, "if" => 35);
        static $filters = array("clean_class" => 17, "escape" => 34);
        static $functions = array("attach_library" => 39);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
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
