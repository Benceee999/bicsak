<?php
session_start();

//http://localhost/bicsak/belepes.php?kilepes=1
if(isset($_GET['kilepes'])){
    session_unset();
}

?>



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



    $eredmeny = "";
    $eredmenySzovegek = array(
        "Nincs ilyen felhasználónév",
        "Sikertelen belépés: hibás jelszó",
        "Sikeres belépés"
    );

    
    if(isset($_POST['felhnev']) && isset($_POST['jelszo'])){
        $login = $szemely-> checkLogin($_POST['felhnev'],$_POST['jelszo']);
        $eredmeny = $eredmenySzovegek[$login];
    }
    
    if(!(isset($_SESSION['id']))){
        echo ('<form method ="post" action = "belepes.php">
        Felhasználónév: <input type="text" name="felhnev" placeholder="írd be a felhasználó neved" required="required"> <br>
        Jelszó: <input type="password" name="jelszo" required="required"><br>
        <input type = "submit" value="Belépés">
        <p> <?php if(isset($_POST)) echo $eredmeny; ?> </p>
        </form>');
    }
       
        ?>
        <title>Belépés</title>
</head>
<body>
    



    <?php

    
        echo("<a href=\"index.php\"><img src=Back_Arrow.svg.png></a>");
    ?>
    




</body>
</html>
