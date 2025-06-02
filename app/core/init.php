<?php 
spl_autoload_register(function ($classname){
    $filename = "../app/models/" . ucfirst($classname) . ".php";
    if (file_exists($filename)) {
        require $filename;
    }
});

//this is the file that load all the file that need to be loaded everytime the applications is started 

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
?>