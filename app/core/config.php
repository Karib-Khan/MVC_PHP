<?php 

if($_SERVER['SERVER_NAME']=='localhost'){
    define('ROOT','http://localhost/projects/php-mvc/public');
    define('DBHOST','localhost');
    define('DBNAME','erp-system');
    define('DBUSER','root');
    define('DBPASS','');
}else{
    define('ROOT','https://www.youwebsite.com');
}


?>