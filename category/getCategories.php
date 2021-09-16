<?php

require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
// $userId = $_SESSION['id'];
$categoryDao = new CategoryDao();
$categories = $categoryDao->findAll();
// var_dump($categories);
