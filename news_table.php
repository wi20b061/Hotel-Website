<?php
   
   include 'webstructure/head.php';
   include 'webstructure/nav.php';
?>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                 <h1>All Newsposts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Text</th>
                            <th scope="col">Image path</th>
                            <th scope="col">Time</th>
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

                            $sql = "SELECT newspost.newsPostID, newspost.title, newspost.text, newspost.img, 
                            newspost.timestamp FROM newspost ";


                            $stmt = $db_obj->prepare($sql);

                            $stmt->execute();
                            $stmt ->bind_result($newsPostID, $title, $text, $img, $timestamp);

                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $newsPostID . "</td>";
                                echo "<td>" . $title . "</td>";
                                echo "<td>" . $text . "</td>";
                                echo "<td>" . $img . "</td>";                             
                                echo "<td>" . $timestamp . "</td>";
                                echo "<td><a href= 'newspost_details.php?newsPostID= " . $newsPostID . " 'class='btn btn-primary'>Details</a></td>";
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
