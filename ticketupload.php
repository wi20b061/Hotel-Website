<?php

 $uploadDir = "upload/upload_tickets/";

if(!file_exists($uploadDir)) {  //create upload directory if it doesnt exist
    mkdir($uploadDir);
}
$thumbnailDir = "upload/Thumbnail_tickets_ordner/";  //create ordner for thumbnail img

if(!file_exists($thumbnailDir)) {
  mkdir($thumbnailDir);
}

 
    include 'uploads/upload.php';
    
    include 'webstructure/head.php';
?>

<?php
            $uid = 5; // get it from the $_SESSION
            $comment = "empty";
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $target_dir = 'upload/upload_tickets/';
           
            $file = @$_FILES["picture"];
            $picname = explode(".", @$_FILES["picture"]["name"]);
            $target_file = $target_dir . $picname[0] . "_". $timestamp . "." . end($picname);
            //$target_file = $target_dir . $timestamp . "_". basename(@$_FILES["picture"]["name"]);
            $uploadStatus = 1;
            $acceptedtype = ["jpg", "jpeg", "png", "gif"];

            if (isset($_POST["submit"])) {
                if (isset($_POST["comment"]) && !empty($_POST["comment"])) {
                    $comment = $_POST["comment"];
                }

                // Check type
                $uploadExt = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                if (!in_array($uploadExt, $acceptedtype)) {
                    echo "<div class='red'>Sorry, only image-files can be accepted!</div>";
                    $uploadStatus = 0;
                }

                // Check file size
                if ($file["size"] > 15000000) {
                    echo "<div class='red'>Sorry, your file is too big! The maximum file size is 15MB!</div>";
                    $uploadStatus = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "<div class='red'>Sorry, this file already exists!</div>";
                    $uploadStatus = 0;
                }

                // Check if $uploadStatus is 0
                if ($uploadStatus == 0) {
                    echo "Please try again.<br>";
                }

                // If everything is OK, upload the file
                else {
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {
                        createDBentry($comment, $target_file, $uid);
                    } else {
                        echo "<div class='red'>Sorry, something went wrong during the upload.</div>";
                    }
                }
            }

            function createDBentry($c, $path, $user_id) {
                require_once ('dbaccess.php');

                $db_obj = new mysqli($host, $user, $password, $database);
                $sql = "INSERT INTO `tickets` (`file_path`, `comment`, `user_id`) VALUES (?, ?, ?)";
                $stmt = $db_obj->prepare($sql);
                $stmt-> bind_param("ssi", $path, $c, $user_id);

                //bind-param 1 übergabeparameter ist ein String,wobei je zeichen für eine datentyp steht
                //s string
                //i integer
                //d double
                //b blob
                //die weiteren parameter stehen für die Platzhalter in sql
                if ($stmt->execute()) {
                    echo "<div class='green'>The picture has been uploaded.</div>";
                }
                else {
                    echo "<div class='red'>Sorry, something went wrong during the upload.</div>";
                }
                $stmt->close();
                $db_obj->close();
            }

        ?>


<title>Tickets</title>
</head>
<body>
    <?php
        include 'webstructure/nav.php';
    ?>

    <div class="container text-center">
      <h1>Create a news ticket</h1>


<!--für ein fileupload enctype!!!-->
  <form method="post" enctype="multipart/form-data" >
         <div class="col">
                    <textarea rows="1" cols="20" name="title" form="newspost" class="form-control" id="title" placeholder="News Title"></textarea>
                </div>
         <div class="col">
                    <textarea rows="4" cols="50" name="text" form="newspost" class="form-control" id="text" placeholder="News Text"></textarea>
         </div>
         <br>


    <div class="col">
      <!--für 1Fileupload - input type file-->
      <label for="file">Files Upload</label>
      <!--wir benötigen einen name in diesem file is es "file" undimt können wir am 
      server zugreifen $_FILES["file"]-->
      <!--mit accept können wir abstimmen welche file types erlaubt sind-->
     
      <input class="form-control" type="file" accept="image/jpeg"  id="file" name="file">
     
      <br>
      <!--button or input type ="submit"damit formular wird abgesendet-->
     
      <input type="submit" class="btn btn-outline-secondary" value="Upload">

    </div>
    </div>
  </form>



</body>
</html>
