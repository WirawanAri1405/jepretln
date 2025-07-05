<?php

class App{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

  public function __construct() {
    $url = $this->parseURL();

    // Cek folder/controller
    if (isset($url[0], $url[1]) && file_exists("../app/controllers/{$url[0]}/{$url[1]}.php")) {
        $folder = $url[0];
        $controller = $url[1];
        $controllerPath = "../app/controllers/$folder/$controller.php";

            require_once $controllerPath;
            $this->controller = $controller;
            unset($url[0], $url[1]);
            $url = array_values($url);
            
    } elseif (isset($url[0]) && file_exists("../app/controllers/{$url[0]}.php")) {
        $controllerPath = "../app/controllers/{$url[0]}.php";
            require_once $controllerPath;
            $this->controller = $url[0];
            unset($url[0]);
            $url = array_values($url);
        
    }
    else{
        //var_dump($url);
        
        require_once '../app/controllers/' . $this->controller . '.php';
    }

    // Inisialisasi objek controller
    $this->controller = new $this->controller;

   if (isset($url[0]) && method_exists($this->controller, $url[0])) {
    $this->method = $url[0];
    unset($url[0]);
}

    // Sisanya parameter
    $this->params = !empty($url) ? array_values($url) : [];

    // Jalankan
    call_user_func_array([$this->controller, $this->method], $this->params);
}


    public function parseURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}