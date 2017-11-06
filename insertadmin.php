<?php
//入力チェック(受信確認処理追加)
//if(
//  !isset($_POST["name"]) || $_POST["name"]=="" ||
//  !isset($_POST["email"]) || $_POST["email"]=="" ||
//  !isset($_POST["lid"]) || $_POST["lid"]==""||
//  !isset($_POST["lpw"]) || $_POST["lpw"]=="")
//  exit('ParamError');

session_start();
if($_SESSION["kanri_flg"] != 1){
  header("Location: login.php");
  exit;
}

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$lid = $_POST["lid"];
$lpw  = $_POST["lpw"];
$lid = $_POST["lid"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2. DB接続しますS

try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','');
}catch(PDOExeption $e){
    exit('DbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

$stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, email, lid, lpw,
kanri_flg, life_flg )VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6)");
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);
$stmt->bindValue(':a3', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a4', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':a5', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':a6', $life_flg, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: selectadmin.php");
  exit;
}
?>
