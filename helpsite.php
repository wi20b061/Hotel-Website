<?php
    include 'webstructure/head.php';
?>
    <title>Help</title>
</head>
<body>
  <?php
    include 'webstructure/nav.php';
  ?>
<div style="background-image: url('uploads/background.jpg');">
    <br>
    <!--das mit dem offset funktioniert für mobile so nicht!-->
    <div class="container text-center col-sm-6 offset-3 border border-primary alert-secondary rounded"><br>
        <h1 id = "heading-1">Help & Support </h1>
        <br><br>
        <h3> User instructions </h3>
        <br><br>
        <p>
            <a>If you have any problems - please go to the ticket page and fill in the form - or you can upload photos.<br><br>
                Our Service Centre will process your request as soon as possible</a>
                <br><br>
            <a>if you wish to book a room . the Rooms tab will allow you to choose the option that suits you</a>
                <br><br>
            <a>At imprint you can find out more about our hotel</a><br>
        </p>
        <br><br>
        <h3>Tell our support team what you need:</h3>
        <p>
        <form class="helpgroup alert-secondary">
            <label for="user-question">Your request:</label>
            <br>
            <textarea name="user-question" id= "user-question" cols="35" rows="10" placeholder="A problem with ..."></textarea>
            <br>
            <label for="file">Choose file (optional)</label>
            <input name="file" id="file" type="file">
            <br><br>
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
</div>

<?php
    include 'webstructure/footer.php';
?>
