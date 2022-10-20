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

       
        ?>
        <title>Találati lista</title>
</head>
<body>
        <?php
            if(isset($_POST['keresettNev'])){
                if(strlen($_POST['keresettNev'])<3){
                    echo("<a href=\"index.php\"><img src=Back_Arrow.svg.png></a>");
                    echo "<h2>írj be legalább 3 karaktert a kereséshez</h2>";
                }else{
                if($talalatok = $szemely->nevetKeres($_POST['keresettNev'])) {
                    echo("<a href=\"index.php\"><img src=Back_Arrow.svg.png></a>");
                    foreach($talalatok as $kulcs => $nev){
                       echo "<h2><a href = \"index.php?szId=$kulcs\">$nev</a><br></h2>";
                    }
                }else{
                    echo("<a href=\"index.php\"><img src=Back_Arrow.svg.png></a>");
                    echo "<h2>Nem található ilyen név</h2>";
                }
            }
        }
            ?>
</body>
</html>
