<?php
    include 'webstructure/head.php';
?>
    <title>Help</title>
</head>
<body>
  <?php
    include 'webstructure/nav.php';
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

<?php
    include 'webstructure/footer.php';
?>
