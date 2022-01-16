<?php
    require_once "dbaccess.php";

    $uploadDir = "uploads/tmp/";

    if(!file_exists($uploadDir)) {  //create upload directory if it doesnt exist
        mkdir($uploadDir);
    }
    $thumbnailDir = "uploads/news/";  //create ordner for thumbnail img
    if(!file_exists($thumbnailDir)) {
        mkdir($thumbnailDir);
    }

    include 'uploads/uploadT.php';

    include 'webstructure/head.php';
?>
    <title>Ticket</title>
</head>
<body>
    <?php
        include 'webstructure/nav.php';

        $id = $_SESSION['userID']; # read userID from Session

    ?>

    <br>
    <div class="container text-center">
        <h1 id = "heading-1">Create a news ticket</h1>
    </div>
    <br>

    <div class="container">
        <form id="newspost" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="col">
                <textarea rows="1" cols="20" name="title" form="newspost" class="form-control" id="title" placeholder="News Title" required></textarea>
            </div>
            <div class="col">
                <textarea rows="4" cols="50" name="text" form="newspost" class="form-control" id="text" placeholder="News Text" required></textarea>
            </div>
            <div class="col">
                <div class="input-group">
                    <div class="custom-file">
                            <input class="custom-file-input" id="file" aria-describedby="file" type="file" name="file" required accept="image/jpeg, image/png, image/gif">
                            <label class="custom-file-label" for="file">Choose news image</label>
                    </div>
                </div>
                <button class="btn btn-outline-secondary" type="submit" name="submit">Publish</button>
            </div>
        </form>
        <br>
        <br>
        <div class="card"><!--style="width: 18rem;"-->
            <div class="col">
                <div class="card-body">
                    <h3 class="card-title">New uploaded image:</h3><br>
                    <?php
                    if(isset($errFileExists)){
                        if($errFileExists){
                            echo '<p class="error">This picture already in the image folder!<br>Please try again.</p>';
                        } else if($errFileSize){
                            echo '<p class="error">This picture is too large!<br>Please try again.</p>'; 
                        }else if($errFileFormat){
                            echo '<p class="error">Only "jpg", "jpeg" and "png" are accepted!<br>Please try again.</p>'; 
                        }else{
                            $thumbnail = $thumbnailDir."thumbnail-".$fileName;
                            if(isset($thumbnail)){
                                echo 'Name: ' .$fileName;
                                echo '<img src="'.$thumbnail.'" alt="newsImage" class="card-img-top"'; //style="width:480px;height:720px">
                                
                            }
                            /**IDEE**: man könnte alle anzeigen und dann eines auswählen können */
                            //This is for showing all thumbnails in the directory
                            if(file_exists($thumbnailDir)){
                                $files = scandir($thumbnailDir);
                                array($files);

                                for($i = 2; isset($files[$i]); $i++){
                                    echo '<li class="list-group-item">' . $files[$i] . '</li>';
                                }
                                if(count($files) == 2){
                                    echo '<li class="list-group-item">No files...</li>';
                               }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
    include 'webstructure/footer.php';
?>