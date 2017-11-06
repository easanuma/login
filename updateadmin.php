<?php

//1. POSTデータ取得
$id = $_POST["id"];
$name   = $_POST["name"];
$email  = $_POST["email"];
$lid = $_POST["lid"];
$lpw  = $_POST["lpw"];
$lid = $_POST["lid"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2.DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e){
    exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name, email=:email, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: selectadmin.php");
  exit;
}

?>
