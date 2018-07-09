<?php

  session_start();

  if($_SESSION['email']){
    echo "<p> User: ".$_SESSION['email']."</p>";
  } else {
    header("Location: index.php");
    exit;
  }

?>

<a href="logout.php">Logout</a>
