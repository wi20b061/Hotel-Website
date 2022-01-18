<?php
   
   include 'webstructure/head.php';
   include 'webstructure/nav.php';
?>

</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-8 text-center">
                 <h1>All users</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6"></div>
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Salutation</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">User name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Active</th>
                            <th scope="col">Role</th>                 
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
                            $sql = "SELECT user.userID, user.salutation, user.fname, 
                            user.lname, user.username, 
                            user.email, user.active, userrole.role FROM user
                            INNER JOIN userrole ON user.roleID=userrole.roleID;";

                            $stmt = $db_obj->prepare($sql);

                            $stmt->execute();
                            $stmt ->bind_result($userID, $salutation, $fname, $lname, $username, 
                            $email, $active, $roleID);

                            while ($stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $userID . "</td>";
                                echo "<td>" . $salutation . "</td>";
                                echo "<td>" . $fname . "</td>";
                                echo "<td>" . $lname . "</td>";
                                echo "<td>" . $username . "</td>";                             
                                echo "<td>" . $email . "</td>";
                                echo "<td>" . $active . "</td>";
                                echo "<td>" . $roleID . "</td>";
                                echo "<td><a href= 'editData.php?userID= " . $userID . " 'class='btn btn-primary'>Update</a></td>";
                                echo "<td><a href= 'editData.php?userID= " . $userID . " 'class='btn btn-primary'>Update</a></td>";
                                echo "<tr>";
                            }
                            //?????????????
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
