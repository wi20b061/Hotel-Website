<?php

$uploadDir = "upload_Guest/";

if(!file_exists($uploadDir)) {  //create upload directory if it doesnt exist
    mkdir($uploadDir);
}
$thumbnailDir = "Thumbnail ordner/";  //create ordner for thumbnail img
if(!file_exists($thumbnailDir)) {
  mkdir($thumbnailDir);
}

//wenn es nicht existiert
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);

    $fileName = $_FILES['file']['name'];

          //gibt es keine errors und passt die größe, dann erzeugen wir einen neuen filenamen, 
                    //der aus einer einzigartigen ID und dem file format, z.b. .png, besteht
                    //$fileNameNew = uniqid('', true).".".$fileActualExt;
                    
                    //dann ändern wir die fileDestination so, dass der neue Name dazu gespeichert wird
                   // $fileDestination = 'uploads/'.$fileNameNew; 


                    // Neue Größe berechnen 
                    list($width, $height) = getimagesize($uploadFile);
                    $newwidth = 480;
                    $newheight = 720;
                    
                    // Bild laden
                    $thumb = imagecreatetruecolor($newwidth, $newheight);//creates background black и создает сам thumb
                    $source = imagecreatefromjpeg($uploadFile);
                    
                    // Skalieren
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    
                    // Ausgabe
                  // imagejpeg($thumb);
                    
                    // Das Bild als 'simpletext.jpg' speichern
                  imagejpeg($thumb, $thumbnailDir."thumbnail-".$fileName);                    
                    // Den Speicher freigeben
imagedestroy($thumb);
                    //
                    //nachdem das file gespeichert worden ist, wollen wir wieder auf unsere fileUpload Seite mit dem 
                    //upload formular zurück und zusätzlich geben wir in der ul noch aus dass das file erfolgreich hochgeladen wurde
                   // header("Location: fileUpload.php?uploadsucess");
                    
                    
}


   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>File uplode</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
</head>
<body>
<?php
        include('nav.php');
    ?>

    <div class="container">
      <h1>File Upload></h1>
<!--für ein fileupload enctype!!!-->
<form method="post" enctype="multipart/form-data" >
  <div class="mb-3">
    <!--für 1Fileupload - input type file-->
    <label for="file">Files Upload</label>
    <!--wir benötigen einen name in diesem file is es "file" undimt können wir am 
    server zugreifen $_FILES["file"]-->
    <!--mit accept können wir abstimmen welche file types erlaubt sind-->
    <input class="form-control" type="file" accept="image/jpeg"  id="file" name="file">
    <br>
     <!--button or input type ="submit"damit formular wird abgesendet-->
    <input type="submit" value="Upload">

  </div>
  </div>
</form>



</body>
</html>