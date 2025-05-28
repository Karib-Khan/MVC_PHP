<?php 

class _404 extends Controller{


  public function index(){
    echo "Controller not found 404 error";

    $this->view("404");
  }

}


?>