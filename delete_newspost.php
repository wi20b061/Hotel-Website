<?php
    include 'webstructure/head.php';
?>
    <title>Home</title>
</head>
<body>
    <?php
        include 'webstructure/nav.php';
        
        //damit nicht unabsichtlich ein Post gelöscht wird, wird bei fehlender Variable 
        //oder falsch gesetzter Variable zur "Edit Newspost"-Seite zurückgeleitet
        if(!isset($_GET["delete"]) || !$_GET["delete"]){
            header('Location: edit_newspost.php');
            die();
        }else if(isset($_GET["delete"]) && $_GET["delete"]){

            //db Verbindung herstellen
            require_once('dbaccess.php');
            $db_obj = new mysqli($host, $user, $password, $database);
            if($db_obj->connect_error){
                echo "Connection Error: " . $db_obj->connect_error;
                exit();
            }

            $newsPostID = $_GET["newsPostID"];
            $sql = "DELETE FROM newspost WHERE newsPostID = $newsPostID";
            $db_obj->query($sql);
            $db_obj->close();
        }
    ?>
    <br><br>
    <div class="container alert alert-danger text-center">
        <h1>The post was deleted successfully!</h1>
    </div>
<?php
    include 'webstructure/footer.php';
?>