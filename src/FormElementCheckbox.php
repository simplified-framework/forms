<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 14:53
 */

namespace Simplified\Forms;


class FormElementCheckbox extends FormElementInput {
    private $label;
    public function __construct(array $options = array()) {
        parent::__construct();
        if (isset($options['value'])) {
            $this->setValue($options['value']);
            unset($options['value']);
        }

        if (isset($options['label'])) {
            $this->setLabel($options['label']);
            unset($options['label']);
        }

        $this->setAttribute('type', 'checkbox');
        $this->setAttribute('value', "");
        $this->setAttributes(array_merge($this->attributes(), $options));
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function render() {
        $this->removeAttribute('class');
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<div class="checkbox"><label><input ' . implode(" ", $attrs) . ' value="'.$this->value().'"/>'.$this->getLabel().'</label></div>';
    }
}