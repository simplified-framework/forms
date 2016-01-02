<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 15:51
 */

namespace Simplified\Forms;


class FormElementSelect extends FormElementInterface{
    private $options = array();

    public function __construct(array $attributes = array()) {
        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
            unset($attributes['value']);
        }

        if (isset($attributes['options'])) {
            $this->setOptions($attributes['options']);
            unset($attributes['options']);
        }

        $this->setAttribute('class', 'form-control');
        $this->setAttributes(array_merge($this->attributes(), $attributes));

    }

    public function getOptions() {
        return $this->options;
    }

    public function setOptions(array $options) {
        $this->options = $options;
    }

    public function addOption(array $option) {
        $this->options[] = $option;
    }

    public function render(){
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        $html = '<select ' . implode(" ", $attrs) . '>';
        if (array_values($this->options) != $this->options) {
            foreach ($this->options as $key => $value) {
                if ($this->value() == $key)
                    $html .= '<option value="' . $key . '" selected>'.$value.'</option>';
                else
                    $html .= '<option value="' . $key . '">'.$value.'</option>';
            }
        } else {
            for ($i = 0; $i < count($this->options); $i++) {
                if ($this->value() == $this->options[$i])
                    $html .= '<option value="' . $this->options[$i] . '" selected>'.$this->options[$i].'</option>';
                else
                    $html .= '<option value="' . $this->options[$i] . '">'.$this->options[$i].'</option>';
            }
        }
        $html.= '</select>';
        return $html;
    }
}