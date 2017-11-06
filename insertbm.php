<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["bookname"]) || $_POST["bookname"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];

//2. DB接続します

try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e){
    exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成

$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, bookname, url, comment)VALUES(NULL, :a1, :a2, :a3)");
$stmt->bindValue(':a1', $bookname, PDO::PARAM_STR);
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: selectbm.php");
  exit;
}
?>


