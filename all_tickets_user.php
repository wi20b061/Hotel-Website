<?php
   
   include 'webstructure/head.php';
   include 'webstructure/nav.php';
?>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                 <h1>All your tickets</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
                <div class="col-8">
                   <!--table head -->
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Text</th>
                            <!--<th scope="col">Image path</th>-->
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                           #db access 
                            require_once('dbaccess.php');

                            $db_obj = new mysqli($host, $user, $password, $database);
                            if ($db_obj->connect_error) {
                                echo "Collection failed!";
                                exit();

                            }
                            if(session_status() == PHP_SESSION_NONE){
                                session_start();
                            }
                            
                            
                            $userID = $_SESSION['userID']; # read userID from Session

                           //DB SQL Abfrage
                            $sql = "SELECT ticket.ticketID, ticket.title, ticket.comment, ticket.text, ticket.img, 
                            ticket.timestamp,ticketstatus.tstatus FROM ticket 
                           INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID
                           WHERE ticket.creatorID = $userID";

                           //use prepare function
                            $stmt = $db_obj->prepare($sql);
                           
                            //execute statement
                            $stmt->execute();
                            $stmt ->bind_result($ticketID, $title, $comment, $text, $img, 
                            $timestamp, $statusID);
                           
                           //show data
                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $ticketID . "</td>";
                                echo "<td>" . $title . "</td>";
                                echo "<td>" . $comment . "</td>";
                                echo "<td>" . $text . "</td>";
                                echo "<td>" . $img . "</td>";                             
                                echo "<td>" . $timestamp . "</td>";
                                echo "<td>" . $statusID . "</td>";
                                echo "<td><a href= 'ticket_details.php?ticketID= " . $ticketID . " 'class='btn btn-primary'>Details</a></td>";
                                echo "<tr>";

                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            <div class="col-2"></div>
        </div>
    </div>

</body>

<?php
    include 'webstructure/footer.php';
?>
