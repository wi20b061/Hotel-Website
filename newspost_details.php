<?php
    include 'webstructure/head.php';
?>
  <title>Details newspost</title>
</head>
<body>   
  <?php
    include 'webstructure/nav.php';

    require_once('dbaccess.php');

    $newsPostID = $_GET["newsPostID"];
    $db_obj = new mysqli($host, $user, $password, $database);
    if($db_obj->connect_error){
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }

    

    //update in DB
    if(isset($_POST["title"]) && isset($_POST["text"]) && !empty($_POST["newsPostID"])) {

        $newsPostID = intval($_POST['newsPostID']);

        $sql = "UPDATE `newspost` SET `title`=?, `text`= ?  WHERE `newsPostID`=?";

        $title = $_POST["title"];
        $text = $_POST["text"];
        //use prepare function
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ssi", $title, $text, $newsPostID );

        //"s" stands for string (string datatype is expected) ... i for integer, d for double
        //followed by the variables which will be bound to the parameters
        
        //executes the statement
        $stmt->execute();
        
        //close the statement
        $stmt->close();
        //close the connection
        $db_obj->close();
        header('Location: ?newsPostID='. $newsPostID);
        die();
    }

    //read from DB
    if (isset($_GET["newsPostID"]) && !empty(["newsPostID"])) {
        $sql = "SELECT * from newsPost WHERE newsPostID =" . $newsPostID;
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($newsPostID, $timestamp, $title, $text, $imgPath);
    }
  ?>
    <!--Card anzeigen mit zu bearbeitenden Post-->
    <div class="news container">
        <h1>Edit Newspost</h1>
            <?php 
                while($stmt->fetch()){
                    echo '<div class="row">';
                    echo '<div class="card w-75 alert-secondary">';
                    echo '<div class="card-header alert-dark">'. substr($timestamp, 0, 10) . '</div>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $title . '</h5>';
                    echo '<p class="card-text">' . $text . '</p>';
                    echo '<img src="' . $imgPath . '" class="card-img-top" alt="picture">';
                    echo '</div>';
                    echo '</div></div><br>';
                }
                $stmt->close();
                $db_obj->close();
            ?>
    </div>

    <!--Formular zur Änderung der Beschreibungen des Posts-->
    <div class="sickbg container jumbotron">
        <h2>Edit Post</h2><br>
        <form method="post"> 
            <div class="form-group ">
                <label for="title">Title:</label>
                <input  class="form-control" name="title" type="text" id="title" placeholder="Title" value="<?php echo $title; ?>"><br>
                <label for="text">Text:</label>
                <input  class="form-control" name="text" type="text" id="text" placeholder="Text" value="<?php echo $text; ?>"><br>
                <input type="hidden" value= "<?php echo $newsPostID ; ?>" name="newsPostID"></input>
            </div>
            <button type='submit' name='submit' class='btn btn-primary' value="id">Update</button><br><br>
            <a class="btn btn-info" href="news_table.php">Go back</a>
        </form>
        <br><br><br>
        <a class="btn btn-danger" href='delete_newspost.php?newsPostID=<?php echo $newsPostID;?>&delete=true'>Delete Post!</a>
    </div>

<?php
    include 'webstructure/footer.php';
?>