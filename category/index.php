<?php
session_start();
require('getCategories.php');
require('../getTask.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="../style.css">
</head>

<div id="wrapper">
    <?php require('../header.php'); ?>
    <div id="category">
        <div class="content">
            <h2>カテゴリ一覧</h2>
            <div class="index">
                <form action="createComplete.php" method="post">
                    <input class="width" type="text" name="name" placeholder="カテゴリー追加" />
                    <input class="input" type="submit" value="登録" />
                </form>
            </div>
            <div class="table">
                <table class="table-list">
                    <?php foreach ($categories as $category) : ?>
                        <tr class="category">
                            <td><?php echo $category['name']; ?></td>
                            <td><a href="/">編集</a></td>
                            <td><a href="/">削除</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <?php require('../footer.php'); ?>
</div>

</html>