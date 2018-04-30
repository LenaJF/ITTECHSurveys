<?php

class View {
    function render($view_name, $template_name,$data = null){
        if(is_array($data)){
            extract($data);
        }
        include 'application/views/'.$template_name.'.php';
    }
}