<?php
session_start();
// require('getTask.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="style.css">
</head>

<div id="category">
    <div class="content">
        <h2>カテゴリ一覧</h2>
        <div class="index">
            <form action="createComplete.php" method="post">
                <input class="width" type="text" name="name" placeholder="カテゴリー追加" />
                <input class="input" type="submit" value="登録" />
            </form>
        </div>
    </div>
</div>

</html>