<?php
// Authors : Udaysri Yadav, Prajodh Valikat, Vijay Kuruva
// Project Group 6
//**************************************************************************
//* DATABASE CLASS FILE
//**************************************************************************
class DatabaseClass {
    
    private static $connection;
    
    /**************** Connection function ********************/
    public function connect() {
        include "./inc/inc_DbConfig.php";
        self::$connection = new mysqli($host, $username, $password, $dbname);
        if (self::$connection->connect_error) {
            throw new ErrorException(self::$connection->connect_error);
        }
    }
    
    /**************** "SELECT" function *********************/
    public function Select($query) {
        
        self::connect();
        
        $result = self::$connection->query ($query);
        if (!$result) {
            throw new ErrorException(self::$connection->error);
        }
        
        self::disconnect();
        return $result;
    }
    /**************** "INSERT/UPDATE/DELETE" function *********************/
    public function Action($query) {
        
        self::connect();
        
        $result = self::$connection->query ($query);
        if ($result) {
            return $result;
        } else {
            throw new ErrorException(self::$connection->error);
        }
        
        self::disconnect();
        return $result;
    }
    
    /***************** Disconnect function *****************/
    public function disconnect() {
        self::$connection->close();
    }
}
?>
