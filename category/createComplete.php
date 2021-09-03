<?php
require_once(__DIR__ . '/..//Infrastructure/Dao/CategoryDao.php');
require_once __DIR__ . '/../Domain/Entity/Category.php';
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
date_default_timezone_set('Asia/Tokyo');

$name = filter_input(INPUT_POST, 'name');
if (!$name) {
    $message = '登録できませんでした';
    echo $message;
    die;
} else {
    $newCategory = new Category(
        null,
        new CategoryName($name)
    );
    $categoryRepository = new CategoryMySqlRepository();
    $categoryRepository->insert($newCategory);
    header('Location: /category/index.php');
}
