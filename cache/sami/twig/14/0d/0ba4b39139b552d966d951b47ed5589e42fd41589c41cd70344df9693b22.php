<?php

/* classes.twig */
class __TwigTemplate_140d0ba4b39139b552d966d951b47ed5589e42fd41589c41cd70344df9693b22 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("layout/layout.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body_class' => array($this, 'block_body_class'),
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["__internal_b3c09e28c294f96eee55d58806fd612bb31bc348c61fcbe466e7d3af07c98fa7"] = $this->env->loadTemplate("macros.twig");
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "All Classes | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = array())
    {
        echo "classes";
    }

    // line 6
    public function block_page_content($context, array $blocks = array())
    {
        // line 7
        echo "    <div class=\"page-header\">
        <h1>Classes</h1>
    </div>

    ";
        // line 11
        echo $context["__internal_b3c09e28c294f96eee55d58806fd612bb31bc348c61fcbe466e7d3af07c98fa7"]->getrender_classes((isset($context["classes"]) ? $context["classes"] : $this->getContext($context, "classes")));
        echo "
";
    }

    public function getTemplateName()
    {
        return "classes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 11,  57 => 7,  54 => 6,  48 => 4,  41 => 3,  37 => 1,  35 => 2,  11 => 1,);
    }
}
