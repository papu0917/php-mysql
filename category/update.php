<?php
require('../redirect.php');

$id = $_POST['category_id'];
$name = filter_input(INPUT_POST, 'category_name');
if (!$name) {
    $message = '更新に失敗しました。カテゴリーを確認してください';
    echo $message;
    // <a href="/index.php">戻る</a>;
    die;
} else {
    $pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
    $stmt = $pdo->prepare("UPDATE categories SET name = :name where categories.id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $res = $stmt->execute();

    $res = redirect();
    die;
}
