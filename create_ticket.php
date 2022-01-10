<?php
    include 'webstructure/head.php';
?>
  <title>Create Ticket</title>
</head>
<body>
      
  <?php
    include 'webstructure/nav.php';
  ?>
 
 <br>

 <div class="container text-center">
     <h1 id = "heading-1">Tickets upload </h1>
</div>
<br>
<div class="container">

    <form action="" id="ticketform" method="POST" enctype="multipart/form-data">
    <div class="col">
            <textarea rows="1" cols="20" name="title" form="ticketform" class="form-control" id="title" placeholder="Title"></textarea>
        </div>
        <div class="col">
            <textarea rows="4" cols="50" name="comment" form="ticketform" class="form-control" id="comment" placeholder="Comment"></textarea>
        </div>
        <div class="col">
            <div class="input-group">
                <div class="custom-file">
                        <input class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" type="file" name="picture" required accept="image/jpeg, image/png, image/gif">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <button class="btn btn-outline-secondary" id="inputGroupFileAddon04" type="submit" name="submit">Upload</button>
                </form>
            </div>

        <?php
            $uid = 2; // get it from the $_SESSION
            $title = "empty";
            $comment = "empty";
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $target_dir = 'pics/';
            $file = $_FILES["picture"];
            echo $file["name"];
            $picname = explode(".", $_FILES["picture"]["name"]); //? wieso neues Array erstellen
            echo $picname;
            $target_file = $target_dir . $picname[0] . "_". $timestamp . "." . end($picname);
            //$target_file = $target_dir . $timestamp . "_". basename(@$_FILES["picture"]["name"]);
            $uploadStatus = 1;
            $acceptedtype = ["jpg", "jpeg", "png", "gif"];

            if (isset($_POST["submit"])) {
                if (isset($_POST["title"]) && !empty($_POST["title"])) {
                    $title = $_POST["title"];
                }
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
    </div>
</div>
</body>
<?php
    include 'webstructure/footer.php';
?>
