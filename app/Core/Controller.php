<?php

class Controller
{
    protected function view($view, $data = array())
    {
        extract($data);

        $viewPath = BASE_PATH . '/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception(
                'Vista no encontrada: ' . $view
            );
        }

        require $viewPath;
    }

    protected function json($data, $status = 200)
    {
        http_response_code($status);

        header(
            'Content-Type: application/json; charset=utf-8'
        );

        echo json_encode(
            $data,
            JSON_UNESCAPED_UNICODE
        );
    }
}