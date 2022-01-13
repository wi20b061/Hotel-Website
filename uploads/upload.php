<?php

    //wenn es nicht existiert
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
        $errFileExists = $errFileFormat = $errFileSize = false;
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));

        //Check: File already exists
        if(file_exists($uploadFile)){
            $errFileExists = true;
        }
        //Check: File size (max. 15 MB)
        else if($_FILES['file']['size'] > 15000000){
            $errFileSize = true;
        }
        //Check: File format (double check because already checked in html form)
        else if($imageFileType != "jpg"
        && $imageFileType != "jpeg"
        && $imageFileType != "png"){
            $errFileFormat = true;
        }else{
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
            $thumb = imagecreatetruecolor($newwidth, $newheight); //creates background black
            if($imageFileType == "jpeg" || $imageFileType == "jpg"){
                $source = imagecreatefromjpeg($uploadFile);
            }else if($imageFileType == "png"){
                $source = imagecreatefrompng($uploadFile);
            }
            
            
            // Skalieren
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            
            // Ausgabe
            // imagejpeg($thumb);
            
            // Das Bild als 'simpletext.jpg' speichern
            
            $thumbnail = $thumbnailDir."thumbnail-".$fileName;
            imagejpeg($thumb, $thumbnail);    

            // Den Speicher freigeben
            imagedestroy($thumb);
            //nachdem das file gespeichert worden ist, wollen wir wieder auf unsere fileUpload Seite mit dem 
            //upload formular zurück und zusätzlich geben wir in der ul noch aus dass das file erfolgreich hochgeladen wurde
            //header("Location: newsPost.php?uploadsucess");

            //Daten in die DB speichern:
            //DB connection
            $db_obj = new mysqli($host, $user, $password, $database);
            if($db_obj->connect_error){
                echo "connection failed!";
                exit();
            }
            //Variablen mit Werten füllen
            $testTitle = $_POST['title'];
            $testText = $_POST['text'];
            $testPfad = $thumbnail;
            //SQL Statement
            $sql = "INSERT INTO newspost (title, text, img) VALUES (?, ?, ?)";
            //Prepare Statement
            $stmt = $db_obj->prepare($sql);
            
            //Parameter übergeben
            //$stmt->bind_param('sss', $_POST['title'], $_POST['text'], $thumbnail);
            $stmt->bind_param('sss', $testTitle, $testText, $testPfad);
            
            //Statement ausführen
            $stmt->execute();
            
    
        }
    }
?>