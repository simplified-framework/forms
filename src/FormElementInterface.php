<?php

namespace Simplified\Forms;

abstract class FormElementInterface {
    private $enabled = true;
    private $attributes = array();
    private $value;

    abstract public function __construct(array $options = array());

    public function setValue($value) {
        $this->value = $value;
    }

    public function value() {
        return $this->value;
    }

    public function setAttributes(array $attrs) {
        $this->attributes = $attrs;
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function removeAttribute($key) {
        if (isset($this->attributes[$key]))
            unset($this->attributes[$key]);
    }

    public function attributes() {
        return $this->attributes;
    }

    public function getAttribute($name) {
        return isset($this->attributes[$name]) ?
            $this->attributes[$name] : null;
    }

    public function setDisabled() {
        $this->enabled = false;
    }

    public function setEnabled() {
        $this->enabled = true;
    }

    public function disabled() {
        return $this->enabled == false;
    }

    public function enabled() {
        return $this->enabled == true;
    }

    abstract public function render();
}