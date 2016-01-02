<?php

namespace Simplified\Forms;


class Form {
    private $elements = array();
    private $attributes = array();

    public function __construct(array $options = array()) {
        $this->attributes['accept-charset'] = 'utf-8';
        $this->attributes['action'] = $_SERVER['REQUEST_URI'];
        $this->attributes['enctype'] = "x-www-form-urlencoded";
        $this->attributes['method'] = "post";

        $this->attributes = array_merge($this->attributes, $options);
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function addElement(FormElementInterface $el) {
        $this->elements[] = $el;
    }

    public function render() {
        // open form
        $attrs = array();
        foreach ($this->attributes as $key => $value) {
            $attr = $key . '="' . $value . '"';
            $attrs[] = $attr;
        }
        $html = '<form ' . implode(" ", $attrs) . ">";

        // render elements
        foreach ($this->elements as $el)
            $html .= $el->render();

        // close form
        $html .= '</form>';
        return $html;
    }
}