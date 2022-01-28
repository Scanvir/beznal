<?php

	//require_once 'core/model.php';
	//require_once 'core/view.php';
	//require_once 'core/controller.php';
	//require_once 'core/route.php';

    function myAutoload ($class_name) {
        $filename = strtolower($class_name) . '.php';
        $file = site_path . 'beznal/application/core/' . $filename;
        if (file_exists($file) == false) {
            return false;
        }
        include ($file);
    }

    spl_autoload_register('myAutoload');

    $registry = new Registry;

    Route::start();