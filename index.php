<?php
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
    <div id="header">
        <div class="header-list">
            <ul>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="">ログアウト</a></li>
                <?php else : ?>
                    <li><a href="">ログイン</a></li>
                <?php endif; ?>
                <li><a href="../Category/index.php">カテゴリー覧</a></li>
                <li><a href="create.php">＋</a></li>
            </ul>
        </div>
    </div>
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
            <div class="title-list">
                <div class="task">タスク名</div>
                <div class="deadline">締め切り</div>
                <div class="category">カテゴリー</div>
            </div>

            <div>
                <table class="table-list">
                    <?php foreach ($dataLists as $data) : ?>
                        <tr>
                            <td><?php echo $data['contents']; ?></td>
                            <td><?php echo $data['deadline']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

</html>