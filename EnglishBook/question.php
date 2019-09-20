<?php
// エラーレベルの管理
error_reporting(E_ALL & ~E_NOTICE);

session_start();
// 答えが入力されると配列に保存していく
if(isset($_POST['answer'])){
  $_SESSION['box'][] = (int)$_POST['answer'];
  $_SESSION['count']++;
  // ある程度回答されたらresultページまで飛ばす
  if($_SESSION['count'] == 11){
    header('Location:results.php');
  }
}

// 問題を表示するためのコマンド
$cn     = mysqli_connect('localhost','root','','yamama');
          mysqli_set_charset($cn,'utf8');
$sql    = "SELECT * FROM word_book";
$result = mysqli_query($cn,$sql);
$rs     = mysqli_fetch_assoc($result);
$row=[];
while($rs){
  $row[]=$rs;
  $rs = mysqli_fetch_assoc($result);
}

$array = array_rand($row,1);
// 配列は０から始まるのでここで＋１してDBから撮ってくる値の調整を行う。
$array_count = $array+1;
$_SESSION['array'] = $array;
$_SESSION['row']   = $row;

//　解答欄に一つだけ正解を混ぜるコマンド
$sql_2 = "SELECT answer FROM word_book where id = $array_count;";
$result_2 = mysqli_query($cn,$sql_2);
$rs_2     = mysqli_fetch_assoc($result_2);
$row_2=[];
$row_2[] = $rs_2;
// 答えの選択肢を順不同で表示するための乱数。
$answer_view = mt_rand(0,2);

mysqli_close($cn);

?>
<!DOCTYPE html>
<html lang="jn" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css.css">
    <script>
    document.addEventListener('touchmove', function(e) {e.preventDefault();}, {passive: false});
    </script>
    <title></title>
  </head>
  <body>
    <form action="question.php" method="post">
    <div id="container">
    <table id="table">
      <tr>
        <td id="header-2"><?php echo $row[$array]['name']; ?></td>
      </tr>
      <tr id="wrap">
        <?php for($i=0;$i<3;$i++){ ?>
          <!-- 必ず一つは答えが必要なのでそれを出しておく（出力する場所はランダム） -->
          <?php if($i == $answer_view){ ?>
            <td id="td">
              <button type="submit" name="answer" value="<?php echo $row_2[0]['answer']; ?>">
              <?php echo $row_2[0]['answer']; ?>
            </button>
           </td>
          <?php } ?>

            <td id="td">
              <button type="submit" name="answer" value="<?php echo mt_rand(0,19); ?>">
                <?php echo $row[mt_rand(0,19)]['answer']; ?>
              </button>
            </td>

        <?php } ?>
      </tr>
    </table>
  </form>
      </div>
  </body>

</html>
