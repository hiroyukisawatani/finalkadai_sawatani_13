<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
require_once("funcs.php");
loginCheck();

//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$ulid       = filter_input( INPUT_POST, "ulid" );
$ulpw       = filter_input( INPUT_POST, "ulpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$ulpw       = password_hash($ulpw, PASSWORD_DEFAULT);

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(user_name,ulid,ulpw,kanri_flg,life_flg)VALUES(:name,:ulid,:ulpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ulid', $ulid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ulpw', $ulpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    //５．index.phpへリダイレクト
    header("Location: user2.php");
    exit;
}
