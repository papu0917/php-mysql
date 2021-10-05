<?php
require_once(__DIR__ . '/../../Infrastructure/Dao/CategoryDao.php');
require_once __DIR__ . '/../../Domain/Entity/Category.php';
require_once __DIR__ . '/../../Interfaces/Repository/CategoryMySqlRepository.php';
date_default_timezone_set('Asia/Tokyo');
header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$name = json_decode(file_get_contents('php://input'), true);
// var_dump($name['name']);
// die;


// $responseBody = [
//     'status' => true,
//     'name' => $name['name'],
//     'message' => 'カテゴリの追加に成功しました'
// ];
// echo json_encode($responseBody);
// die;    

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     $responseBody = [
//         'status' => false,
//         'message' => '不適切なメソッドで呼び出されました'
//     ];
//     echo json_encode($responseBody);
//     die;
// }

// // $categoryName = filter_input(INPUT_POST, $name);
// if (!$name) {
//     $response = [
//         'status' => false,
//         'message' => '名前がありません'
//     ];
//     echo json_encode($response);
//     die;
// }

$newCategory = new Category(
    null,
    new CategoryName($name['name'])
);
$categoryRepository = new CategoryMySqlRepository();
$categoryRepository->insert($newCategory);

$response = [
    'status' => true,
    'name' => $name['name'],
    'message' => '登録に成功しました'
];
echo json_encode($response);
die;
