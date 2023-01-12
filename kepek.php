<style><?php include 'style.css'; ?></style>

<?php
    require 'upload.php';

    /* Displaying Image*/
    $image=$_FILES["fileToUpload"]["name"]; 
    $img="upload/".$image;
    echo '<img src= "'.$img.'">';


?>