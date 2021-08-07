<?php
require_once(__DIR__ . '/Session.php');
$session = Session::getInstance();
$session->clearAuth();

// リダイレクト作る　
header('Location: /index.php');
die;
