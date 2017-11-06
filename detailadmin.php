<?php

session_start();
if($_SESSION["kanri_flg"] != 1){
  header("Location: login.php");
  exit;
}

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','');
} catch (PDOException $e){
    exit('Error'.$e->getMessage());
}

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
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
        <div class="navbar-header"><a class="navbar-brand" href="selectadmin.php">データ一覧</a></div></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="updateadmin.php">
<div>
<h2>ユーザー登録</h2>
</div>
<div>
<label>名前:</label><br>
<input type="name" name="name" value="<?=$row["name"]?>">
</div>
<div>
<lavel>email:</lavel><br>
<input type="email" name="email" value="<?=$row["email"]?>">
</div>
<div>
<label>ID:</label><br>
<input type="lid" name="lid" value="<?=$row["lid"]?>">
</div>
<div>
<label>PW:</label><br>
<input type="lpw" name="lpw" value="<?=$row["lpw"]?>">
</div>
<div>
     <select name="kanri_flg" id="kanri_flg">
     <option value="1" <?php if($row["kanri_flg"]==1){ print "selected";} ?>>管理者</option>
     <option value="0" <?php if($row["kanri_flg"]==0){ print "selected";} ?>>スーパー管理者</option>
     </select>
     <select name="life_flg" id="life_flg">
     <option value="0" <?php if($row["life_flg"]==0){ print "selected";} ?>>使用中</option>
     <option value="1" <?php if($row["life_flg"]==1){ print "selected";} ?>>使用しなくなった</option>
     </select>
</div>
<div>
     <input type="submit" class="submit" value="送信">
</div>
     <input type="hidden" name="id" value="<?=$id?>">
</form>


</body>
</html>






