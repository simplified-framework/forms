<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 15:20
 */

namespace Simplified\Forms;


class FormElementButton extends FormElementInterface{
    public function __construct(array $options = array()) {
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }
        $this->setAttribute('class', 'btn btn-primary');
        $this->setAttributes(array_merge($this->attributes(), $options));
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<button ' . implode(" ", $attrs) . '>'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'</button>';
    }
}