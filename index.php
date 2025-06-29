<?php

header("Content-Security-Policy: default-src 'self';");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("X-Content-Type-Options: nosniff");
header_remove("Server");

    require_once "models/DataBase.php";   
    if (!isset($_REQUEST['c'])) {
        require_once "controllers/Usuarios.php";
        $controller = new Usuarios;
        $controller->consultarRoles();
    } else {        
        $controller = $_REQUEST['c'];        
        require_once "controllers/" . $controller . ".php";
        $controller = new $controller;
        $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'main';        
        call_user_func(array($controller, $action));
    }       
?>
