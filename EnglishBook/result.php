<?php

session_start();
if(!isset($_SESSION['array'])){
  header('Location:error.html');
}
$_SESSION['array']++;
$cn     = mysqli_connect('localhost','root','','yamama');
          mysqli_set_charset($cn,'utf8');
$sql    = "SELECT answer FROM word_book where id = '".$_SESSION['array']."';";
$comand =  mysqli_query($cn,$sql);
$s = mysqli_fetch_assoc($comand);
$rs = [];
$rs[] = $s;
$result=[];
for($i=0;$i<10;$i++){
  if($_SESSION['box'][$i] == 0){
    $result[]  = "○";
  }else{
    $result[] = "×";
  }
}
    session_destroy();
 ?>

<!DOCTYPE html>
<html lang="jn" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php for($j=0;$j<10;$j++){?>
      <p><?php echo $result[$j]; ?></p>
    <?php } ?>
    <a href="index.php">