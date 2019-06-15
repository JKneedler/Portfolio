<?php

  session_start();

  if($_SESSION){
    header("Location: profile.php");
  }

  if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){
    include("connection.php");

    if($_POST['email'] == ''){
      echo "<p>Email address is required.</p>";
    } else if($_POST['password'] == ''){
      echo "<p>Password is required.</p>";
    } else {
      $query = "SELECT `id` FROM `Users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
      $result = mysqli_query($link, $query);
      if(mysqli_num_rows($result) > 0){
        echo "<p>Email is already registered.</p>";
      } else {
        if($_POST['firstName'] == ''){
          echo "<p>First Name is required.</p>";
        } else {
          if($_POST['lastName'] == ''){
            echo "<p>Last name is required.</p>";
          } else {
            $query = "INSERT INTO `Users` (`firstName`, `lastName`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['firstName'])."',
             '".mysqli_real_escape_string($link, $_POST['lastName'])."',
              '".mysqli_real_escape_string($link, $_POST['email'])."',
               '".mysqli_real_escape_string($link, $_POST['password'])."')";
            if(mysqli_query($link, $query)){
              $_SESSION['email'] = $_POST['email'];
              header("Location: profile.php");
              exit;
            } else {
              echo "<p>There was a problem signing you up, please try again later.</p>";
            }
          }
        }
      }
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style/signUpStyle.css" />

    <title>Get Started</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
      <a class="navbar-brand" href="index.php">CC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Connect<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Learn</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">

      <div class="card bg-light" id="signUpForm">
        <div class="card-body" id="signUpCard">
          <h5 class="card-title">Sign Up</h5>
          <form method="post">
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="email">First Name</label>
                  <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="email">Last Name</label>
                  <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input name="email" type="email" class="form-control" id="emailSignUp" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input name="password" type="password" class="form-control" id="passwordSignUp" placeholder="Password">
            </div>
            <input name="signUp" type="hidden" value="1"/>
            <div class="form-group" id="buttonGroupSignUp">
              <button type="submit" class="btn btn-primary" id="signUpButton">Sign Up</button>
              <small id="logInChange" class="form-text text-muted">Already have an account?</small>
              <a class="btn btn-outline-secondary btn-sm" href="login.php">Log In</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>
