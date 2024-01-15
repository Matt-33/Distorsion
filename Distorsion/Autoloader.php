<?php
class Autoloader {
    public static function register() {
        spl_autoload_register(function ($class) {
            $basePath = __DIR__ . '/';
            $classPath = str_replace('\\', '/', $class) . '.php';
            $file = $basePath . $classPath;

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}

Autoloader::register();

?>