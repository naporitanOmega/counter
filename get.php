<?php

//デバック時にエラー表示
//ini_set('display_errors', "On");

define('DATA_FILE', 'data.txt');

$count = getCounter(DATA_FILE);

header('Content-type: application/json');
echo json_encode([
    'status' => true
    ,'count'  => $count
]);

function getCounter($file){
    //データを取得
    $fp = fopen($file, 'r+');
    flock($fp, LOCK_EX);
    $buff = (int)fgets($fp);

    //ファイルを空にする
    ftruncate($fp, 0);
    fseek($fp, 0);

    //+1した数値を書き込む
    fwrite($fp, $buff+1);

    //ファイルを閉じる
    flock($fp, LOCK_UN);
    fclose($fp);

    return($buff);
}