<?php
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/redirect.php');

$session = Session::getInstance();
$session->clearAuth();
redirectSignIn();
die;
