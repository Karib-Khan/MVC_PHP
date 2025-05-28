<?php 
class Database {

    private static $connection = null;
    private function connect() {
        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        try {
            if (self::$connection === null) {
                self::$connection = new PDO($string, DBUSER, DBPASS);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connect();
    }


    public function query($query, $data=[]){
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


    public function get_row($query,$data=[]){
        $conn=$this->getConnection();
        $stm=$conn->prepare($query);
        $check=$stm->execute($data);

        if($check){
            $result=$stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
                return $result[0];
            }
        }
        return false;
    }
}



?>