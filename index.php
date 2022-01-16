<?php
    include 'webstructure/head.php';
?>
    <title>Home</title>
</head>
<body>
    <?php
        include 'webstructure/nav.php';
    ?>

    <?php 
        require_once('dbaccess.php');
                
        $db_obj = new mysqli($host, $user, $password, $database);
        if($db_obj->connect_error){
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }
        $sql = "SELECT * from newsPost ORDER BY timestamp DESC";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($newsPostID, $timestamp, $title, $text, $imgPath);

        /*sort timestamps?
        $sortedArray = rsort($result);
        echo "<pre>" . print_r($sortedArray, true) . "</pre>";*/

    ?>

<!--Hintergrund Bild-->
<div style="background-image: url('uploads/background.jpg');">
    <!--Carousell mit schönen Bildern-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="uploads/carousel/pool.jpg" class="d-block w-100" alt="a outdoor pool in the evening sun with sun umbrellas and pool chairs">
            </div>
            <div class="carousel-item">
                <img src="uploads/carousel/indoor-pool.jpg" class="d-block w-100" alt="Indoor pool with a seatarea behind it">
            </div>
            <div class="carousel-item">
                <img src="uploads/carousel/hotel-bed.jpg" class="d-block w-100" alt="soft and cosy pillows of a white hotel bed">
            </div>
            <div class="carousel-item">
                <img src="uploads/carousel/chill-area.jpg" class="d-block w-100" alt="'chill area' a big room with couches, plants and some tables for guests">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>

    <!--Newsposts Beiträge-->
    <div class="news container">
        <h1><span class="text-white">News</span></h1>
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
</div>
    
    
<?php
    include 'webstructure/footer.php';
?>
