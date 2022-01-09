<?php
class DB
{
    private $connection;
    public $message;

    //construct a connection with the database on local host
    function __construct($servername, $username, $password, $dbname)
    {
        $this->connection = new mysqli($servername, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            $this->message = "Could not connect to the database!";
        }else{
            $this->message = "Successfully connected to the database!";
        }
    }


    // Database of the User: the following user data is saved. All users have a primary unique key 

    function registerUser($user)
    {
        $sql = "insert into user (Salutation, Fname, Lname, Uname, Passwort, Email) 
                 values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $salutation = $user->getSalutation();
        $fname = $user->getFname();
        $lname = $user->getLname();
        $uname = $user->getUname();
        $passwort = $user->getPasswort();
        $email = $user->getEmail();
        $stmt->bind_param("ssssss", $salutation, $fname, $lname, $uname, $passwort, $email);
        $stmt->execute();
    }

    function getUserList(){
        $results = array();
        $sql = "select * from user";
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                foreach($row as $item => $value){
                    $results[$i][$item] = $value;

                }
                $i++;
            }
        }
        return $results;
    }

    function getUser($uname){
        $sql = "select * from user where (Uname = ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result(); 

        //Fetch a result row as an associative array
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();   
            return $user;
        }
        return -1;
    }

    function updateUser($user){
        $id = $user->getId();
        $salutation = $user->getSalutation();
        $fname = $user->getFname();
        $lname = $user->getLname();
        $uname = $user->getUname();
        $passwort = $user->getPasswort();
        $email = $user->getEmail();
       
        $sql = "update benutzer set Salutation = ?, Fname = ?, Lname = ?, Uname = ?, Passwort = ?, Email = ? where ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssssi", $salutation, $fname, $lname,$uname, $passwort, $email, $id);
        $stmt->execute();
    }

    function updatePassword($uname, $passwort){
        $sql = "update user set  Passwort = ? where Uname = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $passwort, $uname);
        $stmt->execute();
    }

    function updateFname($uname, $fname){
        $sql = "update user set Fname = ? where Uname = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $fname, $uname);
        $stmt->execute();
    }

    function updateLname($uname, $lname){
        $sql = "update user set Lname = ? where Uname = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ss", $lname, $uname);
        $stmt->execute();
    }

    function check_for_clients() {
        global $current_user;
    
        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);
    
        return ($user_role == 'client');
    }

    function register_my_menus() {
        register_nav_menus(
          array(
        'client-navigation' => __( 'Client Navigation' ),
        'tech-navigation' => __( 'Tech Navigation' ),
        'admin-navigation' => __( 'Admin Navigation' ),
      
          )
        );
      }
      add_action( 'init', 'register_my_menus' );








    // Pictures via Bilder databan ks 

//to delete a bild from the bilder db
    function deleteBild($id){
        $sql = "DELETE FROM bilder WHERE ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

//when a new bild is added to db
    function uploadBild($bild)
    {
        $sql = "insert into bilder (Name, Latitude, Longitude, Datum, Status, User, Pfad, tag) 
                 values (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $name = $bild->getName();
        $latitude = $bild->getLatitude();
        $longitude = $bild->getLongitude();
        $date = $bild->getDate();
        $status =$bild->getStatus();
        $user = intval($bild->getUser());
        $pfad = $bild->getPfad();
        $tag = $bild->getTag();
        $stmt->bind_param("sddssisi", $name, $latitude, $longitude, $date, $status, $user, $pfad, $tag);
        $stmt->execute();
    }

//select all items from bilder db, based on User parameter
    function getBilderList($user){
        $results = array();
        $sql = "select * from bilder where (User = ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $user);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                foreach($row as $item => $value){
                    $results[$i][$item] = $value;

                }
                $i++;
            }
        }
        return $results;
    }
// get all items from bilder db based on the User and (option) status parameter
    function getBilderListE($user, $status){
        $results = array();
        $sql = "select * from bilder where (User = ?) & (Status = ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("is", $user,$status);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                foreach($row as $item => $value){
                    $results[$i][$item] = $value;

                }
                $i++;
            }
        }
        return $results;
    }

    //get all items based on status: used for Public 
    function getBilderListO($status){
        $results = array();
        $sql = "select b.Name, b.Latitude, b.Longitude, b.Datum, b.Status, b.Pfad, u.Username as User from bilder b join benutzer u on b.User = u.ID where (Status = ?) ";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                foreach($row as $item => $value){
                    $results[$i][$item] = $value;

                }
                $i++;
            }
        }
        return $results;
    }


    
//bild is searched for in db based on the PFAD parameter, which is collected as u travel thru directories
    function getBild($pfad){
        $sql = "select * from bilder where (Pfad = ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $pfad);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();   
            return $user;
        }
        return -1;
    }

    //Freigabe of the picture is set

    function setFreigabe($user, $fuerUser, $bild)
    {
        $sql = "insert into freigabe (User, fuerUser, Bild) 
                 values (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sii", $user, $fuerUser, $bild);
        $stmt->execute();
    }

    //set a corresponding tag for your uploaded photo

    function setTag($tag)
    {
        $sql = "insert into tags (Name) 
                 values ( ? )";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $tag);
        $stmt->execute();
    }

    function getTag($tag)
    {
        $sql = "select * from tags where (Name = ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $tags = $result->fetch_assoc();   
            return $tags;
        }
        return -1;
    }

    function setBildertag($bild, $tag)
    {
        $sql = "insert into bildertag (Bild, Tag) 
                 values (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ii", $bild, $tag);
        $stmt->execute();
    }

}

