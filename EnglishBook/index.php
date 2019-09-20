<?php

if(isset($_POST['next'])){
  session_start();
  $answer_box=[];
  $count = 1;
  $_SESSION['count'] = $count;
  $_SESSION['box'] = $answer_box;
  header('Location:question.php');
  }
 ?>

<!DOCTYPE html>
<html lang="jn" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="ulkit/css/uikit.min.css">
    <link rel="stylesheet" href="css.css">
    <script>
    document.addEventListener('touchmove', function(e) {e.preventDefault();}, {passive: false});
    </script>

  </script>
    <title></title>
  </head>
  <body>
    <div id="container">
    <h1 id="header">英単語帳</h1>
    <form action="index.php" method="post">
    <p id="next">
      <button type="submit" name="next"  id="next">START</button>
    </p>
    </form>
    </div>
  </body>
</html>
