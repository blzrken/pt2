<?php

class Controller {
    protected function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    protected function view($view, $data = []) {
        extract($data, EXTR_SKIP);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    protected function fields(array $names) {
        $data = [];
        foreach ($names as $name) {
            $value = $_POST[$name] ?? null;
            if (!is_string($value) || trim($value) === '' || mb_strlen($value) > 255) {
                abortRequest(422, 'Fill in all required fields.');
            }
            $data[$name] = trim($value);
        }

        return $data;
    }
}
