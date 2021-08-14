<?php
require('../redirect.php');
require_once(__DIR__ . '/../Dao/CategoryDao.php');

$id = $_POST['category_id'];
$name = filter_input(INPUT_POST, 'category_name');
if (!$name) {
    $message = '更新に失敗しました。カテゴリーを確認してください';
    echo $message;
    die;
} else {
    $categoryDao = new CategoryDao();
    $updateCategoryName = $categoryDao->update($id, $name);
    redirectCategoryIndex();
    die;
}
