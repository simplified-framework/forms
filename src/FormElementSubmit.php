<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 15:09
 */

namespace Simplified\Forms;


class FormElementSubmit extends FormElementInput {
    public function __construct(array $options = array()) {
        parent::__construct();
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->setAttribute('type', 'submit');
        $this->setAttribute('class', 'btn btn-primary');
        $this->setAttributes(array_merge($this->attributes(), $options));
        $this->setValue("Submit");
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<input ' . implode(" ", $attrs) . ' value="'.$this->value().'"/>';
    }
}