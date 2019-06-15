<?php
  session_start();

  include("connection.php");

  $userData;

  if($_SESSION){
    $query = "SELECT * FROM `Users` WHERE `email` = '".mysqli_real_escape_string($link, $_SESSION['email'])."'";
    $result = mysqli_query($link, $query);
    $userData = mysqli_fetch_array($result);

    include("changeProfile.php");
  } else {
    header("Location: index.php");
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style/profile.css" />

    <title>Profile</title>
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
          <a class="btn btn-danger" href="logout.php">Log Out</a>
        </form>
      </div>
    </nav>

    <div class="container">

      <div class="card">
        <div class="card-body">
          <div class="row" id="tabRow">
            <div class="col-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="true">Personal</a>
                <a class="nav-link" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">Contact</a>
                <a class="nav-link" id="v-pills-skills-tab" data-toggle="pill" href="#v-pills-skills" role="tab" aria-controls="v-pills-skills" aria-selected="false">Skills/Interests</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
              </div>
            </div>
            <div class="col">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
                  <form method="post">
                    <div class="form-group row">
                      <label for="firstName" class="col-sm-3 col-form-label">Name</label>
                      <div class="col">
                        <div class="form-row">
                          <div class="col">
                            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First"
                            <?php
                              if($userData['firstName'] != ""){
                                echo 'value="'.$userData['firstName'].'"';
                              }
                            ?>
                            >
                          </div>
                          <div class="col-sm-2">
                            <input type="text" name="middleInitial" class="form-control" id="middleInitial" placeholder="M.I."
                            <?php
                              if($userData['middleInitial'] != ""){
                                echo 'value="'.$userData['middleInitial'].'"';
                              }
                            ?>
                             >
                          </div>
                          <div class="col">
                            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last"
                            <?php
                              if($userData['lastName'] != ""){
                                echo 'value="'.$userData['lastName'].'"';
                              }
                            ?>
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                      <div class="col">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $userData['email']; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                      <div class="col">
                        <input type="password" class="form-control" id="inputPw" placeholder="Password" value="<?php echo $userData['password']; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Bio</label>
                      <div class="col">
                        <textarea name="bio" class="form-control" id="bioTextArea" rows="3">
                          <?php
                            if($userData['bio'] != ""){
                              echo ''.$userData['bio'].'';
                            }
                          ?>
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Birthday</label>
                      <div class="col">
                        <div class="form-row">
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="month" placeholder="Month" min="1" max="12">
                          </div>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="day" placeholder="Day" min="1" max="31">
                          </div>
                          <div class="col">
                            <input type="number" class="form-control" id="year" placeholder="Year" min="1900" max="2050">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Gender</label>
                      <div class="col">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="Male"
                          <?php if($userData['gender'] == 0) echo "checked"; ?> >
                          <label class="form-check-label" for="maleRadio">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="Female"
                          <?php if($userData['gender'] == 1) echo "checked"; ?> >
                          <label class="form-check-label" for="femaleRadio">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="Other"
                          <?php if($userData['gender'] == 2) echo "checked"; ?> >
                          <label class="form-check-label" for="otherRadio">Other</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" style="text-align: right;">
                      <div class="col">
                        <input type="text" name="categ" style="display: none;" value="personal"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab">
                  <form method="post">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                      <div class="col">
                        <input type="email" class="form-control" id="inputContactEmail">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Phone Number</label>
                      <div class="col">
                        <input type="text" class="form-control" id="inputPN">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                      <div class="col">
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">Address 2</label>
                      <div class="col">
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">City / State / ZIP</label>
                      <div class="col">
                        <div class="form-group row">
                          <div class="col-md-6">
                            <input type="text" class="form-control" id="inputCity" placeholder="City">
                          </div>
                          <div class="col-md-4">
                            <select id="inputState" class="form-control">
                              <option selected>State</option>
                              <option>Need to finish</option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" id="inputZip" placeholder="ZIP">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row" style="text-align: right;">
                      <div class="col">
                        <input type="text" name="categ" style="display: none;" value="contact"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="v-pills-skills" role="tabpanel" aria-labelledby="v-pills-skills-tab">
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="card">
                        <div class="card-body">
                          Search card
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <p>
                        This is where the skills will go - formatted as individual cards.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">idek, just settings</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
