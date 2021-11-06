<?php
session_start();
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';
require_once __DIR__ . '/../Lib/Redirect.php';
require_once __DIR__ . '/../UseCase/DeleteCategoryUseCase.php';
require_once __DIR__ . '/../UseCase/UseCaseInput/DeleteCategoryUseCaseInput.php';
require_once __DIR__ . '/../Lib/Redirect.php';


$id = filter_input(INPUT_POST, 'id');
$userId = $_SESSION['id'];
$userDao = new UserDao();
$findById = $userDao->findById($userId);

if ($userId === $findById['id']) {
    echo '削除できませんでした。';
}
try {
    $useCaseInput = new DeleteCategoryUseCaseInput($id, $userId);
    $uesCase = new DeleteCategoryUseCase($useCaseInput);
    $uesCase->handler();
    $path = '/category/index.php';
    Redirect::handler($path);
} catch (Exception $e) {
    echo $e->getMessage();
}





// }
// if ($userId['id'] == $user_id) {
//     $categoryId = new CategoryId($id);
//     $categoryRepositroy = new CategoryMySqlRepository();
//     $categoryRepositroy->delete($categoryId);
//     header('Location: /category/index.php');
// } else {
//     echo "削除できませんでした";
