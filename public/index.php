<?php 
session_start();
require "../app/core/init.php";// this line loads everything when application starts
DEBUG ? ini_set('display_errors',1) : ini_set('display_errors',0);
$app=new APP();

$app->loadController();

?>