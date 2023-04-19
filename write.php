<?php
// post手法のデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$score = $_POST["score"];
$comment = $_POST["comment"];

// 投稿時間取得
$date = date("Y/m/d H:i:s");
// ファイルの読み込み
$file = fopen("./data.txt","a");
// ファイルに書き込み
fwrite($file,"<tr><th>".$name.""."</th><td>".$email.""."</td><td>".$score.""."</td><td>".$comment.""."</td><td>".$date.""."</td>");
// ファイルを閉じる
fclose($file);

// ファイルの読み込み
$scoreFile = fopen("./score.txt","a");
// score.txtに書き込み
// fwrite($scoreFile,$score.""."\n");
fwrite($scoreFile,$score."".",");

// ファイルのアップロード
    define( "FILE_DIR", ".img/");
	if( !empty($_FILES['attachment_file']['tmp_name']) ) {

		$upload_res = move_uploaded_file( $_FILES['attachment_file']['tmp_name'], FILE_DIR.$_FILES['attachment_file']['name']);

		if( $upload_res !== true ) {
			$error[] = 'ファイルのアップロードに失敗しました。';
		} else {
			$clean['attachment_file'] = $_FILES['attachment_file']['name'];
		}
	}
// read.phpにリダイレクト
header("location: read.php");
exit();

?>