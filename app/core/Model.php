<?php 

trait Model {
   use Database;
     
    protected $limit='10';
    protected $offset='0';
    protected $order="desc";
    protected $order_column="id";
    public function query($query,$data=[]){
        $conn=$this->getConnection();
        $stm=$conn->prepare($query);
        $check=$stm->execute($data);

        if($check){
            $result=$stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
                return $result;
            }
        }
        return false;
    }


public function findAll(){
    $query="SELECT * from $this->table order by $this->order_column $this->order limit $this->limit offset $this->offset";
    return $this->query($query);
}


public function where($data, $data_not = []) {
    if (empty($data) && empty($data_not)) {
        return false; 
    }

    $keys = array_keys($data);
    $keys_not = array_keys($data_not);

    $query = "SELECT * FROM $this->table WHERE ";

    foreach ($keys as $key) {
        $query .= "$key = :$key AND ";
    }

    foreach ($keys_not as $key) {
        $query .= "$key != :$key AND ";
    }

    $query = rtrim($query, "AND ");
    $query.= " order by $this->order_column $this->order limit $this->limit offset $this->offset";
    $data = array_merge($data, $data_not);
   
    return $this->query($query, $data);
}


 public function first($data, $data_not=[]){
    if (empty($data) && empty($data_not)) {
        return false; 
    }

    $keys = array_keys($data);
    $keys_not = array_keys($data_not);

    $query = "SELECT * FROM $this->table WHERE ";

    foreach ($keys as $key) {
        $query .= "$key = :$key AND ";
    }

    foreach ($keys_not as $key) {
        $query .= "$key != :$key AND ";
    }

    $query = rtrim($query, "AND ");

    $data = array_merge($data, $data_not);

    $result= $this->query($query, $data);
    if($result){
        return $result[0];
    }
    return false;

 }
 public function insert($data){
    if(empty($data)){
        return false;
    }
    
      //remove unwanted data//

    if (!empty($this->allowedColumns)) {
        foreach($data as $key=>$value){
         if(!in_array($key, $this->allowedColumns)){
            unset($data[$key]);
         }
        }
    }

    $keys=array_keys($data);
    //$query = "INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (:" . implode(', :', $keys) . ")";


    $query="INSERT INTO $this->table (";
    foreach($keys as $key){
        $query.=$key.',';
    }
    $query=rtrim($query,',');
    $query.=") VALUES(";

    foreach ($keys as $key) {
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ','); 
    $query .= ")";

    echo $query;
    return $this->query($query, $data);

 }

 public function update($id, $data, $id_column = 'id') {
     //remove unwanted data//

    if (!empty($this->allowedColumns)) {
        foreach($data as $key=>$value){
         if(!in_array($key, $this->allowedColumns)){
            unset($data[$key]);
         }
        }
    }

    $keys = array_keys($data);
    $query = "UPDATE $this->table SET ";

    foreach ($keys as $key) {
        $query .= "$key = :$key, ";
    }

    $query = rtrim($query, ', ');
    $query .= " WHERE $id_column = :$id_column";
    $data[$id_column] = $id;

    return $this->query($query, $data);
}

public function delete($id, $id_column = 'id') {
    $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
    return $this->query($query, [$id_column => $id]);
}



}

?>