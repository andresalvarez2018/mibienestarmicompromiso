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

/* themes/contrib/gin/templates/form/details.html.twig */
class __TwigTemplate_9ad55668a2e9ba67a4937ef12b4c85321c1ea8855852cfd60698995584d77ab9 extends \Twig\Template
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
        // line 28
        $context["classes"] = [0 => "claro-details", 1 => ((        // line 30
($context["accordion"] ?? null)) ? ("claro-details--accordion") : ("")), 2 => ((        // line 31
($context["accordion_item"] ?? null)) ? ("claro-details--accordion-item") : ("")), 3 => ((        // line 32
($context["description_toggle"] ?? null)) ? ("help-icon__description-container") : (""))];
        // line 36
        $context["content_wrapper_classes"] = [0 => "claro-details__wrapper", 1 => "details-wrapper", 2 => ((        // line 39
($context["accordion"] ?? null)) ? ("claro-details__wrapper--accordion") : ("")), 3 => ((        // line 40
($context["accordion_item"] ?? null)) ? ("claro-details__wrapper--accordion-item") : (""))];
        // line 44
        $context["inner_wrapper_classes"] = [0 => "claro-details__content", 1 => ((        // line 46
($context["accordion"] ?? null)) ? ("claro-details__content--accordion") : ("")), 2 => ((        // line 47
($context["accordion_item"] ?? null)) ? ("claro-details__content--accordion-item") : (""))];
        // line 51
        $context["description_classes"] = [0 => "claro-details__description", 1 => ((        // line 53
($context["disabled"] ?? null)) ? ("is-disabled") : ("")), 2 => (((        // line 54
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : (""))];
        // line 57
        echo "<details";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 57), 57, $this->source), "html", null, true);
        echo ">";
        // line 58
        if (($context["title"] ?? null)) {
            // line 60
            $context["summary_classes"] = [0 => "claro-details__summary", 1 => ((            // line 62
($context["required"] ?? null)) ? ("js-form-required") : ("")), 2 => ((            // line 63
($context["required"] ?? null)) ? ("form-required") : ("")), 3 => ((            // line 64
($context["accordion"] ?? null)) ? ("claro-details__summary--accordion") : ("")), 4 => ((            // line 65
($context["accordion_item"] ?? null)) ? ("claro-details__summary--accordion-item") : (""))];
            // line 68
            echo "    <summary";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["summary_attributes"] ?? null), "addClass", [0 => ($context["summary_classes"] ?? null)], "method", false, false, true, 68), 68, $this->source), "html", null, true);
            echo ">";
            // line 69
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 69, $this->source), "html", null, true);
            // line 70
            echo "<span class=\"required-mark\"></span>
      ";
            // line 71
            if ((($context["description"] ?? null) && ($context["description_toggle"] ?? null))) {
                // line 72
                echo "        ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gin/gin_description_toggle"), "html", null, true);
                echo "
        <button class=\"help-icon__description-toggle\"></button>
      ";
            }
            // line 75
            echo "    </summary>";
        }
        // line 77
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_wrapper_classes"] ?? null)], "method", false, false, true, 77), 77, $this->source), "html", null, true);
        echo ">
    ";
        // line 78
        if ((($context["accordion"] ?? null) || ($context["accordion_item"] ?? null))) {
            // line 79
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["class" => ($context["inner_wrapper_classes"] ?? null)]), "html", null, true);
            echo ">
    ";
        }
        // line 81
        echo "
      ";
        // line 82
        if (($context["errors"] ?? null)) {
            // line 83
            echo "        <div class=\"form-item form-item--error-message\">
          ";
            // line 84
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 84, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 87
        if (($context["description"] ?? null)) {
            // line 88
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(), "addClass", [0 => ($context["description_classes"] ?? null)], "method", false, false, true, 88), 88, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 88, $this->source), "html", null, true);
            echo "</div>";
        }
        // line 90
        if (($context["children"] ?? null)) {
            // line 91
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 91, $this->source), "html", null, true);
        }
        // line 93
        if (($context["value"] ?? null)) {
            // line 94
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 94, $this->source), "html", null, true);
        }
        // line 97
        if ((($context["accordion"] ?? null) || ($context["accordion_item"] ?? null))) {
            // line 98
            echo "    </div>
    ";
        }
        // line 100
        echo "  </div>
</details>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/gin/templates/form/details.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 100,  137 => 98,  135 => 97,  132 => 94,  130 => 93,  127 => 91,  125 => 90,  118 => 88,  116 => 87,  110 => 84,  107 => 83,  105 => 82,  102 => 81,  96 => 79,  94 => 78,  89 => 77,  86 => 75,  79 => 72,  77 => 71,  74 => 70,  72 => 69,  68 => 68,  66 => 65,  65 => 64,  64 => 63,  63 => 62,  62 => 60,  60 => 58,  56 => 57,  54 => 54,  53 => 53,  52 => 51,  50 => 47,  49 => 46,  48 => 44,  46 => 40,  45 => 39,  44 => 36,  42 => 32,  41 => 31,  40 => 30,  39 => 28,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/gin/templates/form/details.html.twig", "/app/web/themes/contrib/gin/templates/form/details.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 28, "if" => 58);
        static $filters = array("escape" => 57);
        static $functions = array("attach_library" => 72, "create_attribute" => 79);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                ['attach_library', 'create_attribute']
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
