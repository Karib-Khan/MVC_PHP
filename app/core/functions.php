<?php 
class functions{
    public static function show($value){
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    
    }

    public static function esc($str){
       return htmlspecialchars(($str));
    }
}
?>