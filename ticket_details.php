<?php
    include 'webstructure/head.php';
    include 'webstructure/nav.php';
?>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                 <h1>Ticket Details</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
                <div class="col-8">

                    <?php
                    //connect to DB
                        require_once('dbaccess.php');

                        $db_obj = new mysqli($host, $user, $password, $database);
                        if ($db_obj->connect_error) {
                            echo "Collection failed!";
                            exit();
                        }

                        //get Ticket ID and create query
                        $ticketID = $_GET['ticketID'];

                        $sql = "SELECT ticket.ticketID, ticket.title, ticket.comment, ticket.text, ticket.img, 
                        ticket.timestamp,ticketstatus.tstatus FROM ticket 
                        INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID WHERE ticketID = ? ;";

                        //use prepared stmt
                        $stmt = $db_obj->prepare($sql);
                        $stmt->bind_param('i',$ticketID);

                         //execute stmt
                        $stmt->execute();
                        $stmt ->bind_result($ticketID, $title, $comment, $text, $img, $timestamp, $statusID);

                       $stmt->fetch();
                    ?>

                        <div class="class">
                            <div class="class-header">
                                <?php echo $statusID?>
                            </div>  
                            <img src="<?php echo $img ?>" class="card-img-top" alt="Ticket image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $timestamp ?></h6>
                                <?php if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 2):?>
                                <a href="edit_ticket.php?ticketID=<?php echo $ticketID?>" class="btn btn-primary">Edit</a><br><br>
                                <?php endif;?>
                                <a class="btn btn-info" href="
                                <?php if(isset($_SESSION["userrole"]) && ($_SESSION["userrole"] == 1 || $_SESSION["userrole"] == 2)){
                                    echo "table.php";
                                }elseif(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 3){
                                    echo "all_tickets_user.php";
                                }?>
                                ">Go back</a>
                            </div>
                            </div>
                        </div>
                    <div class="col-2"></div>
                </div>
            </div>
</body>

<?php
    include 'webstructure/footer.php';
?>
