<?php
include 'webstructure/head.php';
?>
    <title>All Tickets</title>
</head>
<body>
  <?php
    include 'webstructure/nav.php';
  ?>
    <br>
    <div class="container">


        require_once ('dbaccess.php');

        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $sql = "SELECT * FROM tickets";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($ticketID, $file_path, $title, $comment, $userID);
    ?>

    <h1>Tickets</h1>
    <table border="1">
        <th>Ticket ID</th>
        <th>User ID</th>
        <th>Title</th>
        <th>Comment</th>
        <th>Picture</th>

        <?php
            while ($stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $ticketID . "</td>";
                echo "<td>" . $userID . "</td>";
                echo "<td>" . $title . "</td>";
                echo "<td>" . $status . "</td>";
                echo "<td>" . $text . "</td>";
                echo "<td>" . $comment . "</td>";
                echo "<td><a href='" . $file_path . "' target='_blank'><img src='$file_path' alt='picture' height='50'></a>". "</td>";
                echo "</tr>";
            }
            $stmt->close();
            $db_obj->close();
        ?>
    </table>

</body>
</html>

<?php
    include 'webstructure/footer.php';
?>
