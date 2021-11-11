</html><!DOCTYPE html>
<html lang="en">
<head>
    <title>Help</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <!--Navbar-->
    <?php
       include 'nav.php';
    ?>

    <br>
    <div class="container text-center">
    <h1 id = "heading-1">Help & Support </h1>
    <h3>Tell our support team what you need:</h3>
    <p>
        <form class="helpgroup">
            <label for="user-question">Your request:</label><br>
            <textarea name="user-question" id= "user-question" cols="35" rows="10" placeholder="A problem with ..."></textarea><br>
            <label for="file">Choose file (optional)</label>
            <input name="file" id="file" type="file"><br><br>
            <button type="submit">Send request</button>
        </form>
    </p>
    <div>
    <p>You can also contact us under:</p>
    </div>
    <div>
        <p> hilfseite@kleinhotel.at </p>
    </div>
    </div>
</body>
</html>
