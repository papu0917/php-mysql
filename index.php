<?php
ini_set('display_errors', 'on');
session_start();
require('getTask.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク管理</title>
    <link rel="stylesheet" href="style.css">
</head>

<div id="wrapper">
    <?php require('header.php'); ?>
    <div id="content">
        <div class="main">
            <div class="box">
                <div class="uncomplete-button"><a href="">未完了</a></div>
                <div class="complete-button"><a class="complete" href="">完了</a></div>
            </div>
            <div class="task-search">
                <form action="user_list.php" method="post">
                    <input type="text" class="form" placeholder="キーワードを入力" name="">
                    <input type="submit" class="button" value="検索">
                </form>
            </div>
            <h2 class="title">未完了タスク一覧</h2>
            <table class="table-list">
                <thead>
                    <tr>
                        <th>タスク名</th>
                        <th>締め切り</th>
                        <th>カテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataLists as $dataList) : ?>
                        <tr>
                            <td><?php echo $dataList['contents']; ?></td>
                            <td><?php echo $dataList['deadline']; ?></td>
                            <td><?php echo $dataList['name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php require('footer.php'); ?>
</div>

</html>