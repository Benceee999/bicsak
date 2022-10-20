<?php
       class DataBase{
        private $servername = "localhost";
        private $username = "admin";            // ezt át kell írni sajátra
        private $password = ")9erVvI_a*Y//7mp"; // ezt át kell írni sajátra
        private $dbname = "phpteszt";           // ezt át kell írni sajátra

        private $conn;
       
        // Create connection
        function __construct(){
            $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);

            $this->conn = $conn;

            // Check connection

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        
        public function dbSelect($sql){
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return $result;
            }else{ 
                  return NULL;
            }
        }
    }
?>