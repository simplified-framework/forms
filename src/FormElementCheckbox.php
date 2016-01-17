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
        $this->setAttributes(array_merge($this->attributes(), $options));
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setChecked($checked) {
        if ($checked)
            $this->setAttribute('checked', true);
        else
            $this->removeAttribute('checked');
    }

    public function getChecked() {
        return $this->getAttribute('checked');
    }

    public function render() {
        $css_class = $this->getAttribute('class');
        $this->removeAttribute('class');

        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            if ($key == 'checked' && empty($value))
                continue;
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<label class="'.$css_class.'"><input ' . implode(" ", $attrs) . ' value="'.htmlspecialchars($this->value(),ENT_QUOTES, 'UTF-8').'"/>'.$this->getLabel().'</label>';
    }
}