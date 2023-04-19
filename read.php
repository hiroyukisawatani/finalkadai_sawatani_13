
<?php

// XSS対策
function h ($value){
    return htmlspecialchars($value,ENT_QUOTES);
}

// dataファイルを変数に指定
$dataFile = './data.txt';

// dataファイルを開く
$dfp = fopen($dataFile,'r');

// 行末までループ
while(!feof($dfp)){
    // ファイル読み込み、変数に指定
    $txt = fgets($dfp);
}

// dataファイルを閉じる
fclose($dfp);




// scoreファイルを変数に指定
$scoreFile = './score.txt';

// scoreファイルを開く
$sfp = fopen($scoreFile,'r');

// 行末までループ
while(!feof($sfp)){
    // ファイル読み込み、変数に指定
    $stxt = fgets($sfp);
}

// scoreの数列を配列に変更
$scr = explode(",",$stxt);
// scoreの平均を算出
$scrSum = array_sum($scr);
$scrAverage = $scrSum/(count($scr)-1);
$scrAverageRound = round($scrAverage,2);

if($scrAverage < 1.5){
    $star = "☆";
}
elseif($scrAverage < 2.5) {
    $star = "☆☆";
}
elseif($scrAverage <3.5){
    $star = "☆☆☆";
}
elseif($scrAverage <4.5){
    $star = "☆☆☆☆";
}
elseif($scrAverage <=5){
    $star = "☆☆☆☆☆";
}

// dataファイルを閉じる
fclose($sfp);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <table>
     <tr><th>名前</th><td>メールアドレス</td><td>評価</td><td>コメント</td><td>日時</td></tr>
    </table>
    <table>
     <?=$txt?>
    </table>
    <div id="hyoukaran">
        <p id="score"><?=$scrAverageRound?></p>
        &nbsp;&nbsp;&nbsp;
        <p id="star"><?=$star?></p>
    </div>
    

</body>
</html>
