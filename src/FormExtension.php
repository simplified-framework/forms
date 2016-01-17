<?php

use Simplified\Forms\FormElementInput;
use Simplified\Forms\FormElementPassword;
use Simplified\Forms\FormElementButton;
use Simplified\Forms\FormElementCheckbox;
use Simplified\Forms\FormElementRadio;
use Simplified\Forms\FormElementReset;
use Simplified\Forms\FormElementSubmit;
use Simplified\Forms\FormElementTextArea;
use Simplified\Forms\FormElementSelect;
use Simplified\Forms\FormElementToken;
use Simplified\Forms\FormElementSlugField;
use Simplified\Forms\FormElementEditor;
use Simplified\Forms\FormElementTagInput;

if (class_exists('\\Simplified\\TwigBridge\\TwigRenderer')) {
    class SimplifiedFormExtension extends \Twig_Extension {
        public function getFunctions() {
            return array(
                'form_open'  => new \Twig_SimpleFunction('form_open',
                    array($this, 'form_open'),array('is_safe' => array('html'))
                ),
                'form_close' => new \Twig_SimpleFunction('form_close',
                    array($this, 'form_close'),array('is_safe' => array('html'))
                ),
                'form_input' => new \Twig_SimpleFunction('form_input',
                    array($this, 'form_input'),array('is_safe' => array('html'))
                ),
                'form_password' => new \Twig_SimpleFunction('form_password',
                    array($this, 'form_password'),array('is_safe' => array('html'))
                ),
                'form_button' => new \Twig_SimpleFunction('form_button',
                    array($this, 'form_button'),array('is_safe' => array('html'))
                ),
                'form_checkbox' => new \Twig_SimpleFunction('form_checkbox',
                    array($this, 'form_checkbox'),array('is_safe' => array('html'))
                ),
                'form_radio' => new \Twig_SimpleFunction('form_radio',
                    array($this, 'form_radio'),array('is_safe' => array('html'))
                ),
                'form_reset' => new \Twig_SimpleFunction('form_reset',
                    array($this, 'form_reset'),array('is_safe' => array('html'))
                ),
                'form_submit' => new \Twig_SimpleFunction('form_submit',
                    array($this, 'form_submit'),array('is_safe' => array('html'))
                ),
                'form_textarea' => new \Twig_SimpleFunction('form_textarea',
                    array($this, 'form_textarea'),array('is_safe' => array('html'))
                ),
                'form_select' => new \Twig_SimpleFunction('form_select',
                    array($this, 'form_select'),array('is_safe' => array('html'))
                ),
                'form_token' => new \Twig_SimpleFunction('form_token',
                    array($this, 'form_token'),array('is_safe' => array('html'))
                ),
                'form_slug' => new \Twig_SimpleFunction('form_slug',
                    array($this, 'form_slug'),array('is_safe' => array('html'))
                ),
                'form_editor' => new \Twig_SimpleFunction('form_editor',
                    array($this, 'form_editor'),array('is_safe' => array('html'))
                ),
                'form_taginput' => new \Twig_SimpleFunction('form_taginput',
                    array($this, 'form_taginput'),array('is_safe' => array('html'))
                ),
            );
        }

        public function form_open(array $options = array()) {
            $default_options = array(
                'method' => 'post',
                'enctype' => 'x-www-form-urlencoded',
                'action' => $_SERVER['REQUEST_URI'],
                'accept-charset' => 'utf-8'
            );
            $attrs = array_merge($default_options, $options);

            $form_attrs = array();
            foreach ($attrs as $key => $value) {
                $form_attrs[] = $key . '="' . $value . '"';
            }
            return '<form ' . implode(" ", $form_attrs) . '>';
        }

        public function form_close() {
            return '</form>';
        }

        public function form_input(array $options = array()) {
            $el = new FormElementInput($options);
            return $el->render();
        }

        public function form_password(array $options = array()) {
            $el = new FormElementPassword($options);
            return $el->render();
        }

        public function form_button(array $options = array()) {
            $el = new FormElementButton($options);
            return $el->render();
        }

        public function form_checkbox(array $options = array()) {
            $el = new FormElementCheckbox($options);
            return $el->render();
        }

        public function form_radio(array $options = array()) {
            $el = new FormElementRadio($options);
            return $el->render();
        }

        public function form_reset(array $options = array()) {
            $el = new FormElementReset($options);
            return $el->render();
        }

        public function form_submit(array $options = array()) {
            $el = new FormElementSubmit($options);
            return $el->render();
        }

        public function form_textarea(array $options = array()) {
            $el = new FormElementTextArea($options);
            return $el->render();
        }

        public function form_select(array $options = array()) {
            $el = new FormElementSelect($options);
            return $el->render();
        }

        public function form_token() {
            $el = new FormElementToken();
            return $el->render();
        }

        public function form_slug(array $options = array()) {
            $el = new FormElementSlugField($options);
            return $el->render();
        }

        public function form_editor(array $options = array()) {
            $el = new FormElementEditor($options);
            return $el->render();
        }

        public function form_taginput(array $options = array()) {
            $el = new FormElementTagInput($options);
            return $el->render();
        }

        public function getName() {
            return 'SimplifiedFormExtension';
        }
    }

    \Simplified\TwigBridge\TwigRenderer::registerExtension(new SimplifiedFormExtension());
}