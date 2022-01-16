<?php
    include 'webstructure/head.php';

  $tstatusErr=$commentErr= "";

  $status="";
  $comment="";
?>

<?php
    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
        echo "Collection failed!";
        exit();}

        //update in DB
    if(isset($_POST["comment"]) && isset($_POST["ticketID"]) && !empty($_POST["ticketID"])
    && isset($_POST["statusID"]) && !empty($_POST["statusID"])) {

      $ticketID = intval($_POST['ticketID']);

      $statusID = intval($_POST['statusID']);
      $sql = "UPDATE `ticket` SET `comment`=?, `statusID`= ?  WHERE `ticketID`=?";     

      $comment = $_POST["comment"];
    //use prepare function
    $stmt = $db_obj->prepare($sql);
    $stmt->bind_param("sii", $comment, $statusID, $ticketID );
   
    //executes the statement
    $stmt->execute();
    
      //close the statement
    $stmt->close();
    //close the connection
    $db_obj->close();
    header('Location: ?ticketID='. $ticketID);
    die();
    }

    //read from DB
    if (isset($_GET["ticketID"]) && !empty(["ticketID"])) {

    $sql = "SELECT ticket.comment, ticketstatus.tstatus FROM ticket  
    INNER JOIN ticketstatus ON ticket.statusID=ticketstatus.statusID
     WHERE ticket.ticketID = ? ;";

    $stmt = $db_obj->prepare($sql);

    $ticketID = intval($_GET['ticketID']);

    $stmt->bind_param("i", $ticketID );

    $stmt->execute();
    $stmt ->bind_result( $comment, $status);

    $stmt->fetch();

    }
?>


<head>
<title>Edit ticket</title>
</head>
<body>
      
  <?php
    include 'webstructure/nav.php';
  ?>
 
 <br>

 <div class="container text-center">
     <h1 id = "heading-1">Update Ticket </h1>
</div>
<br>

<div class=container>

<div class="sickbg container jumbotron">
    
    <form name="kiki" action="#" method="post"> 
   
 
      <div class="form-group col-md-4">
            <label for="status">Status</label>
            
            <select autocomplete="off" id="status" name="statusID" class="form-control" >
            <option  <?php if ($status=="open") {echo "selected"; }?> value="1" >open</option>
            <option  <?php if ($status=="closed.failed") {echo "selected"; }?> value="3">closed.failed</option>
            <option  <?php if ($status=="closed.success") {echo "selected"; }?> value="2" >closed.success</option>
            
            </select>
        </div> 
    
    <div class="form-group ">
        <label for="comment">Comment:</label>
        
        <input  class="form-control" name="comment" type="text" id="comment" placeholder="Comment" value="<?php echo $comment; ?>" />

        <input type="hidden" value= "<?php echo $ticketID ; ?>" name="ticketID"></input>
    </div>

    <button type='submit' name='submit' class='btn btn-primary' value="id"> Update </button>
    
    </form>
</div> 


</body>
<?php
    include 'webstructure/footer.php';
?>