<?php 

class Home extends Controller{


  public function index($a='',$b='',$c=''){
    
    echo "This is the Home controller";

    
    $user =new User();
    $data=["id"=>26];
    //$result=$user->where($data);
    $result=$user->findAll();
     functions::show($a);
     functions::show($b);
     functions::show($c);
    $this->view('home');


  }

}


?>