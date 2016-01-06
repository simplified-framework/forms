<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 19.12.2015
 * Time: 14:36
 */

namespace Simplified\Forms;


class FormElementToken extends FormElementInterface {
    public function __construct(array $options = array()) {
        $this->setAttribute('type', "hidden");
        $this->setAttribute('name', '_token');

        $token = md5(time());
        $_SESSION['_token'] = $token;
        $this->setValue($token);
    }

    public function render() {
        $attrs = array();
        foreach ($this->attributes() as $key => $value) {
            $attrs[] = $key . '="' . $value . '"';
        }

        return '<input ' . implode(" ", $attrs) . ' value="'.$this->value().'"/>';
    }
}