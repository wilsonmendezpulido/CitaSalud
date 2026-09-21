<?php

class Router
{
    private $routes = array();

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    private function addRoute($method, $uri, $action)
    {
        $this->routes[] = array(
            'method' => $method,
            'uri'    => $uri,
            'action' => $action
        );
    }

    public function dispatch($method, $requestUri)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);

        $basePath = '/CitaSalud/public';

        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = '/' . trim($uri, '/');

        if ($uri === '/') {
            $uri = '/';
        }

        foreach ($this->routes as $route) {

            if (
                $route['method'] === $method &&
                $route['uri'] === $uri
            ) {

                $controller = $route['action'][0];
                $action = $route['action'][1];

                $controllerInstance = new $controller();

                call_user_func(
                    array($controllerInstance, $action)
                );

                return;
            }
        }

        http_response_code(404);

        echo "404 - Página no encontrada";
    }
}