<?php

//1.  DB接続します
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','');
} catch (PDOException $e){
    exit('Error'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detailbm.php?id='.$result["id"].'">';
    $view .= $result["bookname"];
    $view .= '</a>　';
    $view .= '<a href="deletebm.php?id='.$result["id"].'">';
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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>bookデータ一覧</title>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="indexbm.php">bookデータ登録</a><br>
          <a class="navbar-brand" href="selectadmin.php">ユーザーデータ一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>

<!-- Main[End] -->

</body>
</html>
