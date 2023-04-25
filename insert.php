<?php
session_start();

//1. POSTデータ取得
$name   = $_POST["name"];
$language  = $_POST["language"];
$amount = $_POST["amount"];
$sns = $_POST["sns"];

// セッション変数からID取得
$user_id = $_SESSION['user_id'];


//2. DB接続します
require_once("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(user_id,name,language,amount,sns,indate)VALUES(:user_id,:name,:language,:amount,:sns,sysdate())");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':language', $language, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':amount', $amount, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sns', $sns, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("index.php");
}
?>
