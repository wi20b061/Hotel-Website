<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration form</title>
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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #98c0dd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="./registration_form.php">Registration<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./imprint.php">Imprint</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./helpsite.php">Help</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rooms
                  </a>
                  <div class="dropdown-menu" style="background-color: #c2d3df;" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#";>Double Bedroom</a>
                    <a class="dropdown-item" href="#">Suite</a>
                    <a class="dropdown-item" href="#">Grand Suite</a>
                  </div>
                </li>

              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>
    </div>

    <br>

    <!-- Gäste-Registrierung für das Semesterprojekt. Dieses Formular beinhaltet folgende Felder: 
    E-Mail-Adresse, Anrede (select), Vorname, Nachname, Postleitzahl, Ort, Straße, Hausnummer-->
        <!--form action="results.html" method="GET"-->
        <br>

        <h1 class="page-header text-center">User registration</h1><br/>
        <title>Please fill in your information:</title><br/><br/>

        <div class="container">
        <form>
            <div class="form-group ">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-4">
                    <label for="inputGender">Gender</label>
                    <select id="inputGender" class="form-control">
                      <option selected>Choose...</option>
                      <option>Female</option>
                      <option>Male</option>
                      <option>Non-binary</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="fistname">First Name</label>
                    <input type="text" class="form-control" id="firstname" placeholder="John">
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Doe">
                </div>
            </div>
            <div class="form-group col-md-6">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group col-md-6">
              <label for="inputAddress2">Address details</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio">
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>Germany</option>
                  <option>Sweden</option>
                  <option>Monaco</option>
                  <option>Norway</option>
                  <option>Denmark</option>
                  <option>Finland</option>
                  <option>Ukraine</option>
                  <option>Luxemburg</option>
                  <option>Niederland</option>
                  <option>Czech Republic</option>
                  <option>Portugal</option>
                  <option>Switzerland</option>
                  <option>Poland</option>
                  <option>Spain</option>
                  <option>France</option>
                  <option>Italy</option>
                  <option>Great Britain</option>
                  <option>USA</option>
                  <option>Australia</option>
                  <option>Canada</option>
                  <option>Russia</option>
                  <option>Belarus</option>
                  <option>China</option>
                  <option>India</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>

            <div class="form-group col-md-2">
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Remember me
                </label>
              </div>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>