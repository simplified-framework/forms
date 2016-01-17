<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 15:20
 */

namespace Simplified\Forms;


class FormElementTextArea extends FormElementInterface{
    public function __construct(array $options = array()) {
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->setAttribute('cols', 50);
        $this->setAttribute('rows', 5);
        $this->setAttribute('class', 'form-control');
        $this->setAttributes(array_merge($this->attributes(), $options));
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<textarea ' . implode(" ", $attrs) . '>'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'</textarea>';
    }
}