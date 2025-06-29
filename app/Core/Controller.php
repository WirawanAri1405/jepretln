<?php

class Controller{
    public function view($view,$data = []){
        require_once '../app/views/'. $view . '.php';
    }
    public function model($model){
        require_once '../app/models/'.$model . '.php';
        return new $model;
    }
    /**
     * Helper function to check if the current request is for an admin route.
     * This makes the constructor logic cleaner.
     * @return bool
     */
    private function isAdminRoute() {
        // Get the path part of the URL, e.g., "/jepretln/public/admin/dashboard"
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Explode the path into segments: ["jepretln", "public", "admin", "dashboard"]
        $segments = explode('/', trim($path, '/'));

        // Find the key for the 'public' segment.
        $publicKey = array_search('public', $segments);

        // Check if 'public' was found and if the very next segment is 'admin'
        if ($publicKey !== false && isset($segments[$publicKey + 1]) && $segments[$publicKey + 1] === 'admin') {
            return true;
        }

        return false;
    }


    public function __construct() {
        // FIRST, check if we are in an admin route.
        if ($this->isAdminRoute()) {
            
            // This entire block of code will ONLY run for /admin/... URLs

            $publicControllers = ['Login', 'LaporanKinerja'];
            $currentController = get_class($this);

            if (!in_array($currentController, $publicControllers)) {
                // If a session is not already started, start one.
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // If the user is not logged in...
                if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
                    // ...redirect them to the admin login page.
                    Flasher::setFlash('Gagal', 'Anda harus login untuk mengakses halaman ini.', 'danger');
                    header('Location: ' . BASEURL . '/admin/login');
                    exit;
                }
            }
        }
        // If it's not an admin route (e.g., /users), the constructor does nothing
        // and the request continues normally.
    }

}