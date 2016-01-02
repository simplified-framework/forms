<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 14:36
 */

namespace Simplified\Forms;


class FormElementPassword extends FormElementInterface {
    public function __construct(array $options = array()) {
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->setAttribute('type', "password");
        $this->setAttribute('class', "form-control");
        $this->setAttributes(array_merge($this->attributes(), $options));
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<input ' . implode(" ", $attrs) . ' value="'.$this->value().'"/>';
    }
}