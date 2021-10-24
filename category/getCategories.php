<?php
$session = Session::getInstance();
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');

$userId = $_SESSION['id'];
$categoryDao = new CategoryDao();
$categories = $categoryDao->findAll($userId);
