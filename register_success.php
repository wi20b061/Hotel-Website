<?php
    include 'webstructure/head.php';
?>
    <title>Successful Registration</title>
</head>
<body>
    <!--Diese Seite wird nach erfolgreicher Regestrierung angezeigt-->
    <?php
        include 'webstructure/nav.php';
    ?>
    <!--Wenn ein Admin einen neuen Service Techniker angelegt hat-->
    <?php 
    if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1 && $_GET["user"] == "service"):?>
    
    <div class="container text-center">
        <div class="alert alert-info">
            <h1>A new service engineer was successfully registered!</h1>
        </div>
    </div>
    <!--Wenn ein Admin einen neuen Gast angelegt hat-->
    <?php elseif(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1 && $_GET["user"] == "guest"):?>
    
    <div class="container text-center">
        <div class="alert alert-info">
            <h1>A new guest was successfully registered!</h1>
        </div>
    </div>
    <!--Wenn ein anonymer User sich selbst Regestriert hat-->
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