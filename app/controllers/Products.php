<?php 

class Products extends Controller{

    public function index(){
        echo "This is the product controller";
        $this->view("products");
    }

}

?>