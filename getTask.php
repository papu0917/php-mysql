<?php
require_once(__DIR__ . '/Dao/TaskDao.php');
$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}

$taskDao = new TaskDao();
$incompleteTasks = $taskDao->findByAll($userId);
arsort($incompleteTasks);
