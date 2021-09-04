<?php
require_once(__DIR__ . '/Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/Domain/ValueObject/UserId.php';
require_once __DIR__ . '/Interfaces/Repository/TaskMySqlRepository.php';

$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}

// $taskId = new TaskId($userId);
// $taskRepositroy = new TaskMySqlRepository();
// $incompleteTasks = $taskRepositroy->findAllByUserId($taskId);

$taskDao = new TaskDao();
$incompleteTasks = $taskDao->findAllByUserId($userId);
arsort($incompleteTasks);
