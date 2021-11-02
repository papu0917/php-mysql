<?php
require('../redirect.php');
// require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';

$id = $_POST['category_id'];
$name = filter_input(INPUT_POST, 'category_name');
if (!$name) {
    $message = '更新に失敗しました。カテゴリーを確認してください';
    echo $message;
    die;
} else {
    $updateCategory = new Category(
        new CategoryId($id),
        new CategoryName($name)
    );
    $categoryRepository = new CategoryMySqlRepository();
    $categoryRepository->update($updateCategory);
    redirectCategoryIndex();
    die;
}
