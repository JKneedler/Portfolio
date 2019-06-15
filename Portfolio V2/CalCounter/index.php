<?php
  session_start();

  include("connection.php");
  include("getDate.php");

?>

<!DOCTYPE html>
<html lang="en">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Tracker</title>
      <!-- Your custom styles (optional) -->
      <link href="Style/style.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="css/mdb.min.css" rel="stylesheet">
  </head>

  <body>
    <div id="mainPage" class="showElement">
      <div id="mainContainer" class="container">
        <div class="row">
          <div class="col">

          </div>
          <div id="middleMain" class="col-6">
            <p id="calNum"><?php
                echo ''.$dayData['calCount'].'';
              ?></p>
          </div>
          <div class="col">

          </div>
        </div>
      </div>
      <div id="bBar" class="container">
        <div id="buttons" class="row">
          <div id="left" class="col nonMiddle">
            <a class="btn-floating grey darken-4"><i class="fa fa-bar-chart-o"></i></i></a>
          </div>
          <div id="middle" class="col-6 buttonParent">
            <a id="exerciseB" class="btn-floating btn-lg grey darken-4 disableButton"><i class="fa fa-bicycle"></i></a>
            <a id="foodB" class="btn-floating btn-lg grey darken-4" style="display: none;"><i class="fa fa-cutlery fa-lg"></i></a>
            <a id="mainB" class="btn-floating btn-lg grey darken-4 mainB"><i class="fa fa-plus fa-lg"></i></a>
          </div>
          <div id="right" class="col nonMiddle">
            <a id="listFoods" class="btn-floating grey darken-4"><i class="fa fa-list"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div id="foodsPage" class="hideElement">
      <div class="container" style="padding: 0px;">
        <div id="header" class="row" style="margin: 0px;">
          <div class="col-3">
            <button id="backB" type="button" class="btn btn-flat" style="width: inherit;"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 1.75rem;"></i></button>
          </div>
          <div class="col" style="text-align: center;">
            <h1>Activity</h1>
          </div>
          <div class="col-3">
            <button id="editB" type="button" class="btn btn-flat" style="width: inherit;"><i class="fa fa-minus-square-o" aria-hidden="true" style="font-size: 1.75rem;"></i></button>
          </div>
        </div>
        <table class="table">
          <tbody>
            <tr class="itemRow">
              <td><h4>Item #1</h4></td>
              <td class="itemAmt"><h4 class="red-text">-300</h4></td>
              <td class="delItem hideElement"><a class="btn-floating btn-sm red darken-1"><i class="fa fa-times"></i></a></td>
            </tr>
            <tr class="itemRow">
              <td><h4>Item #2</h4></td>
              <td class="itemAmt"><h4 class="red-text">-250</h4></td>
              <td class="delItem hideElement"><a class="btn-floating btn-sm red darken-1"><i class="fa fa-times"></i></a></td>
            </tr>
            <tr class="itemRow">
              <td><h4>item #3</h4></td>
              <td class="itemAmt"><h4 class="red-text">-400</h4></td>
              <td class="delItem hideElement"><a class="btn-floating btn-sm red darken-1"><i class="fa fa-times"></i></a></td>
            </tr>
            <tr class="itemRow">
              <td><h4>Item #4</h4></td>
              <td class="itemAmt"><h4 class="green-text">+300</h4></td>
              <td class="delItem hideElement"><a class="btn-floating btn-sm red darken-1"><i class="fa fa-times"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div id="statsPage">

    </div>

    <div id="addFoodPage" class="hideElement">
      <div class="container" style="padding: 0px;">
        <div id="header" class="row" style="margin: 0px;">
          <div class="col-3">
            <button id="backBAdd" type="button" class="btn btn-flat" style="width: inherit;"><i class="fa fa-times" aria-hidden="true" style="font-size: 1.75rem;"></i></button>
          </div>
          <div class="col" style="text-align: center;">
          </div>
          <div class="col-3">
          </div>
        </div>
        <form method="post">
          <div id="foodInputs">
            <div class="md-form form-lg fInputCon" id="fNameInputCon">
              <input type="text" id="fNameInput" class="form-control form-control-lg fInput" placeholder="Food" name="itemName">
            </div>
            <div class="md-form form-lg fInputCon" id="fCalInputCon">
              <input type="text" id="fCalInput" class="form-control form-control-lg fInput" placeholder="0" name="itemAmt">
              <input type="text" id="hiddenGo" value="true" name="go" style="display: none;">
            </div>
          </div>
          <button id="submitB" type="submit" name="newItem" class="btn btn-success btn-lg btn-block">
            <i class="fa fa-angle-double-right" aria-hidden="true" style="font-size: 3rem;"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Hammer Library -->
    <script type="text/javascript" src="hammer.min.js"></script>
    <!-- My Javascript -->
    <script type="text/javascript" src="app.js"></script>
  </body>

</html>
