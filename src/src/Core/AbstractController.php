<?php

namespace Core;

abstract class AbstractController{

    protected function render($view, $params = null){
        if(isset($params)){
            extract($params);
        }
        include __DIR__ . "/../../views/{$view}.php";
    }

}