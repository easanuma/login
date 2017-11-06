<?php
session_start();
if($_SESSION["kanri_flg"] != 1){
  header("Location: login.php");
  exit;
}

//1.  DB接続します
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','');
} catch (PDOException $e){
    exit('Error'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれるS
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detailadmin.php?id='.$result["id"].'">';
    $view .= $result["id"]." ".$result["name"];
    $view .= '</a>　';
    $view .= '<a href="deleteadmin.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ユーザー登録</title>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="indexadmin.php">ユーザー登録</a><br>
      <a class="navbar-brand" href="selectbm.php">bookデータ一覧</a>
        </div></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
  
<a class="navbar-brand" href="logout.php">ログアウト</a>
<!-- Main[End] -->

</body>
</html>
