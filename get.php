<?php

//デバック時にエラー表示
//ini_set('display_errors', "On");

define('DB_DSN', 'mysql:dbname=access;host=127.0.0.1');
define('DB_USER', 'senpai');
define('DB_PW', 'indocurry');

$dbh = connectDB(DB_DSN, DB_USER, DB_PW);

addCounter($dbh);

$count = getCounter($dbh);

header('Content-type: application/json');
echo json_encode([
    'status' => true
    ,'count'  => $count
]);

function connectDB($dsn, $user, $pw){
    $dbh = new PDO($dsn, $user, $pw);
    return($dbh);
}

function addCounter($dbh){
    $sql = 'INSERT INTO access_log(accesstime) VALUES(now())';

    $sth = $dbh->prepare($sql);
    $ret = $sth->execute();

    return($ret);
}

function getCounter($dbh){

    $sql = 'SELECT count(*) as count FROM access_log';

    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $buff = $sth->fetch(PDO::FETCH_ASSOC);
    if($buff === false){
        return(false);
    }
    else{
        return($buff['count']);
    }
}