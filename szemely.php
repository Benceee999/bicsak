<?php

    require_once 'db.php';
    
    class Szemely{
        private $szId;
        private $nev;

        private $db;

        function __construct($db){
            $this->db=$db;
            }

        public function getNev($szId){
            $sql= "SELECT nev from szemelyek where szId = ".$szId;  //át írni saját adatbázis mezőnevekre
            if ($resultNev= $this->db->dbSelect($sql)) {
                $szemelySor = $resultNev->fetch_assoc();
                $this->nev = $szemelySor['nev'];
                $this->szId = $szId;
        }
            return $this->nev;
        }

        public function nevetKeres($szoveg){
            $talalatok = array();
            $sql = "SELECT szId,nev FROM `szemelyek` WHERE `nev` LIKE '%$szoveg%'"; //át írni saját adatbázis mezőnevekre
            if($result = $this->db->dbSelect($sql)){
                while($row = $result->fetch_assoc()){
                    $talalatok[$row['szId']] = $row['nev'];
                }
            }
            return $talalatok;
        }

        public function GetOsztaly($szemelyId){
            $sql = "SELECT osztId FROM `sorok` WHERE (";
            for($i=1;$i<=5;$i++){
                $sql .= "nev$i = ".$szemelyId;
                if($i<5) $sql .= " OR ";
                else $sql .= ")";
            }
            if($result = $this->db->dbselect($sql)){
                if($row = $result -> fetch_assoc()){
                    return $row['osztId'];
                }
            }
        }
        public function checkLogin($felhNev,$jelszo){
            $sql = "SELECT * from szemelyek where felhasznalonev ='".$felhNev."'";
        if($result = $this->db->dbSelect($sql)){
            if($row = $result->fetch_assoc()){
                if($row['jelszo'] == md5($jelszo)){
                    $eredmeny= 2; //"Sikeres belépés;
                    $_SESSION["nev"] = $row['nev'];
                    $_SESSION["id"] = $row['szId'];
                }else{
                    $eredmeny= 1; //"Sikertelen belépés: hibás jelszó";
                    }
                }
            }
            else{
                $eredmeny= 0; //"Nincs ilyen felhasználónév: ";
            }
            return $eredmeny;
        }
    }

?>