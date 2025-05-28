<?php 

class Home extends Controller{


  public function index(){
    
    echo "This is the Home controller";

    $this->view('home');
    $model =new Model();
    $data=["name"=>'NablaTabla',"age"=>25];
    $model->insert($data);
    


  }

}


?>