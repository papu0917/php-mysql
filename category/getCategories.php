<?php

require_once(__DIR__ . '/../Dao/CategoryDao.php');
$categoryDao = new CategoryDao();
$categories = $categoryDao->findByAll();
