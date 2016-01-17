<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 15:09
 */

namespace Simplified\Forms;


class FormElementReset extends FormElementInput {
    private $label;
    public function __construct(array $options = array()) {
        parent::__construct();
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        $this->setAttribute('type', 'reset');
        $this->setAttribute('class', 'btn btn-default');
        $this->setAttributes(array_merge($this->attributes(), $options));
        $this->setValue("Reset");
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<input ' . implode(" ", $attrs) . ' value="'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'"/>';
    }
}