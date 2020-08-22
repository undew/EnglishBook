<?php

// session_start();
// if(!isset($_SESSION['array'])){
//   header('Location:error.html');
// }
$_SESSION['array']++;
$cn     = mysqli_connect('localhost','root','','yamama');
          mysqli_set_charset($cn,'utf8');
$sql    = "SELECT answer FROM word_book where id = '".$_SESSION['array']."';";
$comand =  mysqli_query($cn,$sql);
$s = mysqli_fetch_assoc($comand);
$rs = [];
$rs[] = $s;
$result=[];
$answer_result=0;
for($i=0;$i<10;$i++){
  if($_SESSION['box'][$i] == 0){
    $result[]  = "○";
    $answer_result++;
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
    <link rel="stylesheet" href="css.css">
    <title></title>
  </head>
  <body>
    <div id="container">
    <h1 id="result">結果発表</h1>
    <table>
    <?php for($j=0;$j<10;$j++){?>
      <tr class="length"><td><?php echo $j+1; ?>問目：</td>
      <td><?php echo $result[$j]; ?></td></tr>
    <?php } ?>
  </table>
    <p id="fooder">あなたの正答率は１０問中　<?php echo $answer_result; ?>問　です。</p>
    <form action="index.php" method="post">
    <button type="submit" name="button">TOP</button>
  </form>
  </div>
  </body>
</html>
