<?php

  session_start();

  if($_SESSION){
    header("Location: profile.php");
  }

  if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){
    if(mysqli_connect_error()){
      die("There was an error connecting to the database.");
    }

    if($_POST['email'] == ''){
      echo "<p>Email address is required.</p>";
    } else if($_POST['password'] == ''){
      echo "<p>Password is required.</p>";
    } else {
      $query = "SELECT `id` FROM `Users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
      $result = mysqli_query($link, $query);
      if(mysqli_num_rows($result) > 0){
        if($_POST['signUp'] == '1'){
          echo "<p>Email is already registered.</p>";
        } else {
          $query = "SELECT * FROM `Users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
          $result = mysqli_query($link, $query);
          $userData = mysqli_fetch_array($result);
          if($_POST['password'] == $userData['password']){
            $_SESSION['email'] = $userData['email'];
            header("Location: profile.php");
            exit;
          } else {
            echo "<p>Incorrect Password.</p>";
          }
        }
      } else {
        if($_POST['signUp'] == '1'){
          $query = "INSERT INTO `Users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
          if(mysqli_query($link, $query)){
            $_SESSION['email'] = $_POST['email'];
            header("Location: profile.php");
            exit;
          } else {
            echo "<p>There was a problem signing you up, please try again later.</p>";
          }
        } else {
          echo "<p>Incorrect email or password.</p>";
        }
      }
    }
  }

?>

<html>
  <head>
    <title>Log In/Sign Up</title>
  </head>
  <body>
    <form method="post">
      <input name="email" type="text" placeholder="Email" />
      <input name="password" type="password" placeholder="Password" />
      <input name="signUp" type="hidden" value="1"/>
      <input type="submit" value="Sign Up" />
    </form>
    <form method="post">
      <input name="email" type="text" placeholder="Email" />
      <input name="password" type="password" placeholder="Password" />
      <input name="signUp" type="hidden" value="0"/>
      <input type="submit" value="Log In" />
    </form>
  </body>
</html>
