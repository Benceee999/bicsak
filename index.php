<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include 'style.css'; ?></style>
        <?php
        require 'db.php';
        $db= new DataBase();

        require 'model/szemely.php';
        $szemely = new Szemely($db);
        require 'model/osztaly.php';

        
       
            $osztaly = 1;

            if(isset($_GET['osztalyId'])){
                $osztaly = $_GET['osztalyId'];
            }
//Melyik osztályban van a keresett személy
            if(isset($_GET['szId'])){
                if($szemelyOsztalya = $szemely->GetOsztaly($_GET['szId'])){
                $osztaly = $szemelyOsztalya;
                }
            }

            $osztalyPeldany = new Osztalyok($osztaly,$db);
            $osztalyok = $osztalyPeldany->getAll($db);


                if(!array_key_exists($osztaly, $osztalyok)){
                    $osztaly = 1;
                }

                $magam = array('sorId' => 42, 'mezoNeve' => 'nev5');    //át írni saját adatbázis mezőnevekre
?>
</head>
<body>

            <form method ="post" action = "lista.php">
            <input type="text" name="keresettNev">
            <input type = "submit" value="KERES">
            </form>

            <?php
                echo("<title>$osztalyok[$osztaly]</title>");

            $sql = "SELECT sorId,nev1,nev2,nev3,nev4,nev5 FROM sorok WHERE osztId LIKE ".$osztaly;  //át írni saját adatbázis mezőnevekre
            $result = $db->dbSelect($sql);

            if ($result = $db->dbSelect($sql)) {
                echo '<table>';
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    for($i=1; $i<6; $i++){
                        $nev = "";
                        $mezonev = 'nev'.$i;
                        if($row[$mezonev]!=NULL){
                            $nev = $szemely->getNev($row[$mezonev],$db);
                        }
                        $bg ="";
                        if(isset($_GET['szId'])){
                            if($_GET['szId'] == $row[$mezonev]){
                                $bg = "background-color: yellow";
                            }
                        }
                        if($row['sorId'] == $magam['sorId'] and $mezonev == $magam['mezoNeve']){
                            echo "<td style=\"color: green;$bg\">".$nev."</td>\n";
                        }else {
                            echo "<td style=\"$bg\">".$nev."</td>\n";
                        }
                    }
                }
                echo '</tr>';
            }
            echo '</table>';

            echo "<h1>$osztalyok[$osztaly]</h1>";

            foreach($osztalyok as $kulcs => $ertek){
                if($kulcs != $osztaly){
                    echo "<h2><a href=\"index.php?osztalyId=$kulcs\">$ertek </a><br></h2>";
                }
            }
        ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
        </form>
        <br>
        <button> <a href="upload.php">Képek</a></button>
</form>
</body>
</html>
