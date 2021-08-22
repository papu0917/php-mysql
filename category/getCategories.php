<?php

require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');

$categoryDao = new CategoryDao();
$categories = $categoryDao->findAll();
