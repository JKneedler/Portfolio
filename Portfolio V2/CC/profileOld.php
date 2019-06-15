<?php
  session_start();

  $link = mysqli_connect("db745389488.db.1and1.com", "dbo745389488", "Jared1997!", "db745389488");
  if(mysqli_connect_error()){
    die("There was an error connecting to the database.");
  }

  $userData;

  if($_SESSION){
    $query = "SELECT * FROM `Users` WHERE `email` = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
    $result = mysqli_query($link, $query);
    $userData = mysqli_fetch_array($result);
  }
?>

<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
  </head>
  <body>
    <div id="topPanel">
      <div id="tabs">
        <a href="index.php">
          <div id="tab0" class="tab">
            <img src="Media/HomeGraphic.png" />
            <p>Home</p>
          </div>
        </a>
        <div id="tab0" class="tab">
          <img src="Media/ConnectGraphic.png" />
          <p>Connect</p>
        </div>
        <div id="tab0" class="tab">
          <img src="Media/ProjectsGraphic.png" />
          <p>Projects</p>
        </div>
        <div id="tab0" class="tab">
          <img src="Media/LearnGraphic.png" />
          <p>Learn</p>
        </div>
      </div>
      <div id="profilePicturePeek">
        <?php
          if($_SESSION){
            echo "<a href='profile.php'>Profile</a><br/>";
            echo "<a href='logout.php'>Logout</a>";
          } else {
            echo "<a href='login.php'>Login</a>";
          }
        ?>
      </div>
    </div>
    <div id="content">
      <!-- <div id="leftPanel">
        <div id="peoplePanel">
          <p>
            People to Know
          </p>
        </div>
      </div>
      <div id="middlePanel">
        <div id="projectsPanel">
          <p>
            Hot Projects
          </p>
        </div>
      </div>
      <div id="rightPanel">
        <div id="forumPanel">
          <p>
            What people are asking
          </p>
        </div>
      </div> -->
    </div>
  </body>
</html>
