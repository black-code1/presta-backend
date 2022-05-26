<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

// $p_url = explode("?", $_SERVER['REQUEST_URI']);
$url = explode("?", $_SERVER['REQUEST_URI']);
$p_url=explode('/',$url[0]);
$get = [];
$savailableparam = ["classroom" => ["id"]];

if (isset($url[1])) {
    # code...
    $params = explode("&", $url[1]);
    if (count($params) > 1) {
        for ($i = 0; $i < count($params); $i++) {
            // if (in_array(explode('=', $params[$i])[0], $savailableparam)) {
                $get[explode('=', $params[$i])[0]] = explode('=', $params[$i])[1];
            // }
        }
    } else {
        $get[explode('=', $params[0])[0]] = explode('=', $params[0])[1];
    }
}

// var_dump($get);

// 127.0.0.1/oas_api/classroom/list_when_area/?area=1
require "system/loader.php";
$loader->init();
if (count($p_url) > 1) {
    # code...

    if (isset($p_url[2])) {
        # code...
        // controller name
        $ressource_name = $p_url[2];
        //echo $ressource_name;
        //check if the ressource asked exist
        if($loader->load_ressource($ressource_name)){
            //create a ressource using the given name
            $ressource = $loader->call($ressource_name);
            // lookin form an eventually action
            if (isset($p_url[3]) && $loader->ressource_has_method($ressource_name, $p_url[3])) {
                # code...
                $method = $p_url[3];
                // lookin form an eventually param
                if (!empty($get)) {
                    # code...
                    echo json_encode($ressource->$method($get));
                } else {
                    echo json_encode($ressource->$method());

                }

            } else {
                echo json_encode(["error" => "method d exist"]);

            }
        }else{
            echo json_encode(["error" => "ressource doesnt exist"]);

        }

    }

}