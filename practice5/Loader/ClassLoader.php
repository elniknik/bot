<?php

namespace Loader;

class ClassLoader {

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new ClassLoader();
        }

        return self::$instance;
    }

    public function init() {
        spl_autoload_register([self::$instance, "load"]);
    }

    public function load($name) {
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/logs/loaders.log", $_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $name) . ".php\n", FILE_APPEND);
        include_once($_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $name) . ".php");
        // $filePath = $_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $name) . ".php";
        // file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/logs/loaders.log", "Trying to load: $filePath\n", FILE_APPEND);
    
        // if (file_exists($filePath)) {
        //     include_once($filePath);
        // } else {
        //     file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/logs/loaders.log", "File not found: $filePath\n", FILE_APPEND);
        // }
    }
}