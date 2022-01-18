<?php
    include 'webstructure/head.php';
?>
    <title>Successful Registration</title>
</head>
<body>
    <?php
        echo $_SESSION["userrole"];
        include 'webstructure/nav.php';
    ?>
    <?php  echo $_SESSION["userrole"];
    if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1 && $_GET["user"] == "service"):?>
    
    <div class="container text-center">
        <div class="alert alert-info">
            <h1>A new service engineer was successfully registered!</h1>
        </div>
    </div>

    <?php elseif(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1 && $_GET["user"] == "guest"):?>
    
    <div class="container text-center">
        <div class="alert alert-info">
            <h1>A new guest was successfully registered!</h1>
        </div>
    </div>

    <?php elseif(!isset($_SESSION["userrole"]) && $_GET["user"] == "guest"):?>
    <div class="container text-center">
        <div class="alert alert-info">
            <h1>Your registration was successful!<br>Please sign in to visit all new pages!</h1>
        </div>
    </div>  
    <?php endif;?>
    
<?php
    include 'webstructure/footer.php';
?>