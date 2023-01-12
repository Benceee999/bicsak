<?php

    require_once 'db.php';
    
    class Osztalyok{
        private $osztId;
        private $osztNev;

        private $db;

        function __construct($osztId,$db){
            $sql = "SELECT osztNev from osztalyok where osztId = ".$osztId; //át írni saját adatbázis mezőnevekre
                if ($result = $db->dbSelect($sql)) {
                    $osztalySor = $result->fetch_assoc();
                    $this->osztnev = $osztalySor['osztNev'];
                    $this->osztId = $osztId;
            }
        }

        public function getOsztaly(){
            return $this->$osztnev;
        }

        public function getAll($db){
            $osztalyok = array();

            $sql = "SELECT osztId,osztNev from osztalyok";  //át írni saját adatbázis mezőnevekre

            if($result = $db->dbSelect($sql)){
                while($row = $result->fetch_assoc()){
                    $osztalyok[$row['osztId']] = $row['osztNev'];   
                }
            }
            return $osztalyok;
        }
    }

?>