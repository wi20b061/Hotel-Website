<?php
   
   include 'webstructure/head.php';
   include 'webstructure/nav.php';
?>

</head>
<body>
    <br>
    <h1 class="text-center">Edit newsposts</h1>
    <br><br><!--In CSS "schöner" machen!-->

    <!--filter-->
    <div class="col-12 text-center">
        <h2>Filter by Title</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
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
                            <th scope="col">Text</th>
                            <th scope="col">Image path</th>
                            <th scope="col">Time</th>
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
                                        
                                        $sql = "SELECT newspost.newsPostID, newspost.title, newspost.text, newspost.img, 
                                        newspost.timestamp FROM newspost WHERE newspost.title LIKE ?";

                                        $stmt = $db_obj->prepare($sql);
                                        $stmt->bind_param("s", $filtervalues);

                                        $stmt->execute();
                                        $stmt ->bind_result($newsPostID, $title, $text, $img, $timestamp);

                                        while ($stmt->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $newsPostID . "</td>";
                                            echo "<td>" . $title . "</td>";
                                            echo "<td>" . $text . "</td>";
                                            echo "<td>" . $img . "</td>";                             
                                            echo "<td>" . $timestamp . "</td>";
                                            echo "<td><a href= 'news_details.php?newsPostID= " . $newsPostID . " 'class='btn btn-primary'>Details</a></td>";
                                            echo "<tr>";
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

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                 <h2>All Newsposts</h2>
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

    
<br><br><br>


</body>

<?php
    include 'webstructure/footer.php';
?>