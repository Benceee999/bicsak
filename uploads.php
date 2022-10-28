<?php
session_start();

$target_dir = "upload/";
$target_file = $target_dir. $_SESSION['id']."";

if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
    
}
?>