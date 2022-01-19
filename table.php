<?php
   
   include 'webstructure/head.php';
   include 'webstructure/nav.php';
?>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                 <h1>All tickets</h1>
            </div>
        </div>
        <div class="row">
            
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Text</th>
                            <th scope="col">Image path</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            require_once('dbaccess.php');

                            $db_obj = new mysqli($host, $user, $password, $database);
                            if ($db_obj->connect_error) {
                                echo "Collection failed!";
                                exit();
                            }

                            $sql = "SELECT ticket.ticketID, ticket.title, ticket.comment, ticket.text, ticket.img, 
                            ticket.timestamp,ticketstatus.tstatus FROM ticket 
                           INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID;";

                            $stmt = $db_obj->prepare($sql);

                            $stmt->execute();
                            $stmt ->bind_result($ticketID, $title, $comment, $text, $img, 
                            $timestamp, $statusID);

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
    </div>

<br><br><br>

<div class="col-12 text-center">
                 <h2>Filter nach Status</h2>
            </div>

<!--filter-->
<div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="card mt-4">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">

                               <h5> Status Types: open | closed.failed | closed.success </h5><br>
                                <!--Search-->                                     
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                               </form>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Text</th>
                            <th scope="col">Image path</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Details</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    //connect with DB
                                    require_once('dbaccess.php');

                                    $db_obj = new mysqli($host, $user, $password, $database);
                                    if ($db_obj->connect_error) {
                                        echo "Collection failed!";
                                        exit();}

                                    if(isset($_GET['search']))
                                    {

                                        $filtervalues = "%" . $_GET['search'] . "%";
                                        
                                       # search Abfrage
                                        $sql = "SELECT ticket.ticketID, ticket.title, ticket.comment, ticket.text, ticket.img, 
                                        ticket.timestamp,ticketstatus.tstatus FROM ticket
                                        INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID WHERE ticketstatus.tstatus LIKE ? "; 

                                       #use prepared stmt
                                        $stmt = $db_obj->prepare($sql);
                                       $stmt->bind_param("s", $filtervalues);
                                    
                                       #exectute stmt
                                        $stmt->execute();
                                        $stmt ->bind_result($ticketID, $title, $comment, $text, $img, 
                                        $timestamp, $statusID);

                                       #result
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
                                            echo "</tr>";
            
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
    include 'webstructure/footer.php';
?>
