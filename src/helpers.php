<?php

function errors_msg($field) {
    $errors = Session::get('errors');

    if($errors && $errors->has($field)) {
        $msg = $errors->first($field);
        return '<p class="help-block">' . $msg . '</p>';
    }

    return '';
}

function field_error($field) {
    $error = '';

    if($errors = Session::get('errors')) {
        $error = $errors->first($field) ? ' has-error' : '';
    }

    return $error;
}

function field_label($name, $label) {
    if(is_null($label)) return '';

    $name = str_replace('[]', '', $name);

    $out = '<label for="' . $name . '" class="control-label">';
    $out .= $label . '</label>';

    return $out;
}

function field_attributes($name, $attributes = [], $noClass = false) {
    $name = str_replace('[]', '', $name);

    return array_merge(['class' => $noClass ? '' : 'form-control', 'id' => $name], $attributes);
}

function field_wrapper($name, $label, $element) {
    $out = '<div class="form-group';
    $out .= field_error($name) . '">';
    $out .= field_label($name, $label);
    $out .= $element;
    $out .= errors_msg($name);
    $out .= '</div>';
    return $out;
}

function form_group($element, $name = '') {

    $out = '<div class="form-group';
    $out .= field_error($name) . '">';
    $out .= $element;
    $out .= errors_msg($name);
    $out .= '</div>';

    return $out;
}

function errors() {
    $out = "";

    if(Session::has('errors')) {
        foreach(Session::get('errors') as $error) {
            $out .= '<p class="help-block">' . $error . '</p>';
        }
    }

    return $out;
}
