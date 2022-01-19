<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }    
?>
<div class="container-flex">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #98c0dd;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./imprint.php">Imprint</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./helpsite.php">Help<!--span class="sr-only">(current)</span--></a>
                </li>
                <?php if(!isset($_SESSION["userID"])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="./registration_form.php">Registration</a>
                </li>
            
                <?php endif ?>

            
                <?php   #admin =1      # Different Menu for different Userrole
                //$_SESSION["userrole"] = 2; #simulation without DB
                
                if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1 ): ?> 
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User Administration
                        </a>
                        <div class="dropdown-menu" style="background-color: #c2d3df;" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./registration_form.php">User registration</a>
                            <a class="dropdown-item" href="./user_table.php">All Users</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            News and Tickets
                        </a>
                        <div class="dropdown-menu" style="background-color: #c2d3df;" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./newspost.php">Create Newspost</a>
                            <a class="dropdown-item" href="./news_table.php">All news posts</a>
                            <a class="dropdown-item" href="./table.php">All tickets</a>
                        </div>
                    </li>
                
                <?php #tech=2
                elseif(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 2 ): ?> 

                    <li class="nav-item">
                        <a class="nav-link" href="./table.php">All tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./editData.php?userID=<?php echo $_SESSION["userID"];?>">Edit Profile</a>
                    </li>
                                    
                <?php  #guest =3
                elseif(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 3 ): ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Cabinet
                        </a>
                        <div class="dropdown-menu" style="background-color: #c2d3df;" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./editData.php?userID=<?php echo $_SESSION["userID"];?>">Edit Profile</a>
                            <a class="dropdown-item" href="./ticketupload.php">Create Ticket</a>
                            <a class="dropdown-item" href="./all_tickets_user.php">Your Tickets</a>
                        </div>
                    </li>

                <?php endif ?> 

                <?php if(isset($_SESSION["userID"])):?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    </li>
                <?php endif ?> 
            </ul>
        </div>
    </nav>
</div>


