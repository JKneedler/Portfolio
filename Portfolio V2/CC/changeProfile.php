<?php

  if($_POST){
    if($_POST['categ'] == "personal"){
      if($_POST['firstName']){
        if($_POST['firstName'] != $userData['firstName']){
          $query = "UPDATE `Users` SET firstName = '".mysqli_real_escape_string($link, $_POST['firstName'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
          $result = mysqli_query($link, $query);
        }
      } else {
        $query = "UPDATE `Users` SET firstName = '".mysqli_real_escape_string($link, "")."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
        $result = mysqli_query($link, $query);
      }

      if($_POST['middleInitial']){
        if($_POST['middleInitial'] != $userData['middleInitial']){
          $query = "UPDATE `Users` SET middleInitial = '".mysqli_real_escape_string($link, $_POST['middleInitial'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
          $result = mysqli_query($link, $query);
        }
      } else {
        $query = "UPDATE `Users` SET middleInitial = '".mysqli_real_escape_string($link, "")."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
        $result = mysqli_query($link, $query);
      }

      if($_POST['lastName']){
        if($_POST['lastName'] != $userData['lastName']){
          $query = "UPDATE `Users` SET lastName = '".mysqli_real_escape_string($link, $_POST['lastName'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
          $result = mysqli_query($link, $query);
        }
      } else {
        $query = "UPDATE `Users` SET lastName = '".mysqli_real_escape_string($link, "")."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
        $result = mysqli_query($link, $query);
      }

      if($_POST['bio']){
        if($_POST['bio'] != $userData['bio']){
          $query = "UPDATE `Users` SET bio = '".mysqli_real_escape_string($link, $_POST['bio'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
          $result = mysqli_query($link, $query);
        }
      } else {
        $query = "UPDATE `Users` SET bio = '".mysqli_real_escape_string($link, "")."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
        $result = mysqli_query($link, $query);
      }
    }
  }

?>
