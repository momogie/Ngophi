<?php

if (! function_exists('View')) {
    function View($name = null, $data = null, $layout=null,$title=null)
    {
        $view = System\Core\Controller::getInstance();
        if (isset($name))
        {
            $view->name = str_replace('.', DIRECTORY_SEPARATOR , $name);
        }

		if (isset($data))
        {
            $view->data = $data;
        }

		if (isset($layout))
        {
            $view->layout = $layout;
        }

		if (isset($title))
        {
            $view->title = $title;
        }
            
        return $view->Render();
    }
}

if (! function_exists('JsonResult')) {
    function JsonResult($data = null,$http_response_code = 200 )
    {
        header("Content-Type: application/json; charset=UTF-8");
        if(is_array($data))
        {
            echo json_encode((array)$data);
        }
        else
        {
            echo $data;
        }
        http_response_code($http_response_code);
        exit();
    }
}
if (! function_exists('Json')) {
    function Json($data = null,$http_response_code = 200 )
    {
        header("Content-Type: application/json; charset=UTF-8");
        if(is_array($data))
        {
            echo json_encode((array)$data);
        }
        else
        {
            echo $data;
        }
        http_response_code($http_response_code);
        exit();
    }
}

if (! function_exists('XMLResult')) {
    function XMLResult($data = null,$http_response_code = 200 )
    {
        header('Content-type: text/xml');
        echo $data;
        http_response_code($http_response_code);
        exit();
    }
}
