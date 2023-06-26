<?php


    function sanitize_data($data){
        return trim(htmlspecialchars(stripcslashes($data)));
    }


?>