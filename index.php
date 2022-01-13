<?php
    require_once('dbaccess.php');
        
    $db_obj = new mysqli($host, $user, $password, $database);
    if($db_obj->connect_error){
        echo "connection failed!";
        exit();
    }

    include 'webstructure/head.php';
?>
    <title>Home</title>
</head>
<body>
    <?php
        include 'webstructure/nav.php';
    ?>
    <!--Carousell mit schönen Bildern-->

    <!--Einen Post auslesen/designen-->
    <?php 
        $sql = "SELECT timestamp from newsPost";
        $result = $db_obj->query($sql);

        echo "<pre>" . print_r($result->fetch_all(), true) . "</pre>";

        /*sort timestamps?
        $sortedArray = rsort($result);
        echo "<pre>" . print_r($sortedArray, true) . "</pre>";*/

    ?>
    
    
<?php
    include 'webstructure/footer.php';
?>