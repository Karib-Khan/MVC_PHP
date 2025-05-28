<?php 
session_start();
require "../app/core/init.php";// this line loads everything when application starts

$app=new APP();

$app->loadController();

?>