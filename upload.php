<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upload.css">
    <title>feltolt</title>
</head>
<body>
    
<?php

if(array_key_exists('fileToUpload', $_FILES)){
  if(array_key_exists('error', $_FILES['fileToUpload']));
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { 
   // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
  $dir = "upload/";
    $image = glob($dir. "/*");
    ?>
 <div class="gallery"><?php 
        foreach($image as $image){
        echo '<img src = "'.$image.'" border="0" />';
    }
  
    ?></div>
        <hr>
        <button> <a href="index.php">Fő oldal</a></button>
        
</body>
</html>