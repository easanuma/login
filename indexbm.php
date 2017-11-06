<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>bookデータ登録</title>
</head>
<body>

<!-- Head[Start] -->
<header>
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="selectbm.php">データ一覧</a></div></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insertbm.php">
  <div class="jumbotron">
    <h2>Book登録</h2>
     <label>本の名前：<input type="text" name="bookname"></label><br>
     <label>本のURL：<input type="text" name="url"></label><br>
     <label>コメント<textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
  </div>
</form>
<!-- Main[End] -->
</body>
</html>
