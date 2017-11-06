<?php

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','');
} catch (PDOException $e){
    exit('Error'.$e->getMessage());
}

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>bookデータ更新</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="selectbm.php">データ一覧</a></div></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="updatebm.php">
  <div class="jumbotron">
    <h2>Book登録</h2>
     <label>本の名前：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>本のURL：<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <label>コメント<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label>
     <input type="hidden" name="id" value="<?=$id?>">
     <br>
     <input type="submit" value="送信">
  </div>
</form>


<!--
<form method="post" action="updatebm.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"><?=$row["naiyo"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
-->
<!-- Main[End] -->


</body>
</html>






