<?php
class Router {
    private $routes = [];

    public function get($url, $handler) {
        $this->routes['GET'][$url] = $handler;
    }

    public function post($url, $handler) {
        $this->routes['POST'][$url] = $handler;
    }

    public function dispatch($url, $method) {
        $url = trim($url, '/');
        $url = $url ?: 'login';
        $method = strtoupper($method);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $handler) {
                $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);
                $pattern = '#^' . $pattern . '$#';
                if (preg_match($pattern, $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    if (is_array($handler)) {
                        [$controller, $action] = $handler;
                        $controllerFile = APP_ROOT . '/app/controllers/' . $controller . '.php';
                        if (file_exists($controllerFile)) {
                            require_once $controllerFile;
                            $instance = new $controller();
                            $instance->$action(...array_values($params));
                        }
                    } elseif (is_callable($handler)) {
                        $handler($params);
                    }
                    return;
                }
            }
        }
        http_response_code(404);
        require_once APP_ROOT . '/app/views/errors/404.php';
    }
}
