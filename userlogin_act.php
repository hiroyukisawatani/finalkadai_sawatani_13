<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//1.  DB接続します
require_once("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
$sql = "SELECT * FROM gs_user2_table WHERE ulid=:ulid AND life_flg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ulid', $_POST["ulid"], PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if( password_verify($_POST["ulpw"] ,$val["ulpw"]) ){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["user_id"]   = $val['id']; 
  redirect("index2.php");
}else{
  //Login失敗時(Logout経由)
  redirect("userlogin.php");
}
exit();
?>

