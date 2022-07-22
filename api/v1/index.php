<?php

    include_once('core/functions.php');

    // Adding [/] to Requested URL at the end if not
    if(! ($_SERVER['REQUEST_URI'])[-1] !== '/') $_SERVER['REQUEST_URI'] .= '/';
    $_SERVER['REQUEST_URI'] = ltrim($_SERVER['REQUEST_URI'], '/');
    
    // Trimming Base url [defined in constants] from the Requested URL and converting to array exploding with [/]
    $request = explode('/', str_replace(BASE_URL, "", $_SERVER['REQUEST_URI']));

    $route = $request[2];
    $action = $request[3];
    
    $results_per_page = 10;
    $page = isset($request[4]) && !empty($request[4]) ? $request[4] : "";
    if($page){
        $page_first_result = ($page-1) * $results_per_page; 
    }
    
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    /* 
        Pair of Key Value Array, containes routes as key, and directory path as value

        Don't Declare Key and value same, it will reveal directory's index
    */
    $routes = [
        "country"=> "country/",
        "currency"=> "currency/",
    ];
    
    if(isset($routes[$route])){
        if (file_exists($routes[$route])) include_once( $routes[$route] . 'index.php' );
        else retResponse(404, 'Route Defined, Folder Not Found', false);
    }
    else retResponse(404, 'Invalid Route from index', false);