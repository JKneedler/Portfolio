<?php //error_reporting(0); ?>
<?php

$_POST = array();
print_r($_POST);

$today = getdate();

$dKey = dateKey($today);

$dayData = refreshDayData($link, $dKey);

if(empty($dayData)){
  $dayData = array();
  $dayData['day'] = ''.$dKey.'';
  $dayData['calCount'] = 0;
}

function dateKey($date){
  $key = ''.$date['mon'].''.$date['mday'].''.$date['year'].'';
  return $key;
}

function refreshDayData($link, $dKey){
  $query = "SELECT * FROM `Totals` WHERE `day` = '".mysqli_real_escape_string($link, $dKey)."'";
  $result = mysqli_query($link, $query);
  return mysqli_fetch_array($result);
}

function addItem($name, $amt, $link, $dKey, $dayData){
  if(!array_key_exists('index', $dayData)){
    $query = "CREATE TABLE `".mysqli_real_escape_string($link, $dKey)."` LIKE `9152018`";
    $result = mysqli_query($link, $query);
    $query2 = "INSERT INTO `Totals` (`day`, `calCount`, `calGoal`) VALUES ('".mysqli_real_escape_string($link, $dKey)."', '0', '3000')";
    $result2 = mysqli_query($link, $query2);
  } else {
    $query = "INSERT INTO `".mysqli_real_escape_string($link, $dKey)."` (`item`, `amount`) VALUES ('".mysqli_real_escape_string($link, $name)."', $amt)";
    $result = mysqli_query($link, $query);
    $newCount = $dayData['calCount'] + $amt;
    $query2 = "UPDATE `Totals` SET `calCount` = $newCount WHERE `day` = '".mysqli_real_escape_string($link, $dKey)."'";
    $result2 = mysqli_query($link, $query2);
  }
}

if($_POST['go'] == 'true'){
    //addItem('testIdk', 20, $link, $dKey, $dayData);
    print_r('run this case');
    $_POST['go'] = 'false';
} else {
  print_r('ignore this case');
}

?>
