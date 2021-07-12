<?php
// $link = mysqli_connect('localhost', 'samplephp', 'samplemysql', 'todolist');

// 接続状況をチェックします
// if (mysqli_connect_errno()) {
//     die("データベースに接続できません:" . mysqli_connect_error() . "\n");
// } else {
//     echo "データベースの接続に成功しました。\n";
// }

try {
    $db = new PDO('mysql:dbname=todolist;host=localhost;charset=utf8', 'samplephp', 'samplemysql');
    echo "接続OK！";
} catch (PDOException $e) {
    echo 'DB接続エラー！: ' . $e->getMessage();
}
