<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Cek folder/controller
        if (isset($url[0], $url[1])) {
            $folder = $url[0];
            $controller = $url[1];
            $controllerPath = "../app/controllers/$folder/$controller.php";

            if (file_exists($controllerPath)) {
                require_once $controllerPath;
                $this->controller = $controller;
                unset($url[0], $url[1]);
            }
        } elseif (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            require_once $controllerPath;
            $this->controller = $url[0];
            unset($url[0]);
        } else {
            // default
            require_once "../app/controllers/Home.php";
            $this->controller = 'Home';
        }

        // Inisialisasi objek controller
        $this->controller = new $this->controller;

        // Cek method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Sisanya parameter
        $this->params = !empty($url) ? array_values($url) : [];

        // Jalankan
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
