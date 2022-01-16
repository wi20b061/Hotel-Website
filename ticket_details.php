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
                        require_once('dbaccess.php');

                        $db_obj = new mysqli($host, $user, $password, $database);
                        if ($db_obj->connect_error) {
                            echo "Collection failed!";
                            exit();

                        }

                        $ticketID = $_GET['ticketID'];

                        $sql = "SELECT ticket.ticketID, ticket.title, ticket.comment, ticket.text, ticket.img, 
                        ticket.timestamp,ticketstatus.tstatus FROM ticket 
                        INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID WHERE ticketID = ? ;";


                        $stmt = $db_obj->prepare($sql);
                        $stmt->bind_param('i',$ticketID);

                        $stmt->execute();
                        $stmt ->bind_result($ticketID, $title, $comment, $text, $img,
                        $timestamp, $statusID);

                       if (!$stmt->fetch()) {
                           # header("Location: table.php");
                           # die();
                        }
                        ?>

                        <div class="class">
                            <div class="class-header">
                                <?php echo $statusID?>
                            </div>
                            <img src="<?php echo $img ?>" class="card-img-top" alt="Ticket image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $timestamp ?></h6>
                                <a href="edit_ticket.php" class="btn btn-primary">Edit</a>
                                <a href="table.php" class="btn btn-primary">Overview</a>
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
