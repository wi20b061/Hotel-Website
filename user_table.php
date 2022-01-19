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
            <table class="table">
                <thead> <!--head of the table-->
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Salutation</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">User name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Active</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>      
                    </tr>
                </thead>
                <tbody>

                    <?php
                        require_once('dbaccess.php'); #connect to DB
                        $db_obj = new mysqli($host, $user, $password, $database);
                        if ($db_obj->connect_error) {
                            echo "Collection failed!";
                            exit();
                        }
                   
                        #create query
                        $sql = "SELECT user.userID, user.salutation, user.fname, 
                        user.lname, user.username, 
                        user.email, user.active, userrole.role FROM user
                        INNER JOIN userrole ON user.roleID=userrole.roleID;";

                        #use prepared stmt
                        $stmt = $db_obj->prepare($sql);

                        #exectute stmt
                        $stmt->execute();
                   
                        $stmt ->bind_result($userID, $salutation, $fname, $lname, $username, 
                        $email, $active, $roleID);

                        #result output
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
                            echo "<td><a href= 'editData.php?userID=" . $userID . "' class='btn btn-primary'>Update</a></td>";
                            //echo "<td><a href= 'editData.php?userID=" . $userID . " 'class='btn btn-primary'>Update</a></td>";
                            echo "</tr>";
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

<?php
    include 'webstructure/footer.php';
?>
