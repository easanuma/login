<?php

session_start();
if($_SESSION["kanri_flg"] != 1){
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- Main[Start] -->
<form method="post" action="insertadmin.php">
<div>
<h2>ユーザー登録</h2>
</div>
<div>
<label>名前:</label><br>
<input type="name" name="name"/>
</div>
<div>
<lavel>email:</lavel><br>
<input type="email" name="email"/>
</div>
<div>
<label>ID:</label><br>
<input type="lid" name="lid"/>
</div>
<div>
<label>PW:</label><br>
<input type="lpw" name="lpw"/>
</div>
<div>
     <select name="kanri_flg" id="kanri_flg">
     <option value="1">管理者</option>
     <option value="0">スーパー管理者</option>
     </select>
     <select name="life_flg" id="life_flg">
     <option value="0">使用中</option>
     <option value="1">使用しなくなった</option>
     </select>
</div>
<div>
     <input type="submit" class="submit" value="送信">
</div>
</form>
<!-- Main[End] -->

</body>
</html>
