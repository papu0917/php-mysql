<?php
ini_set('display_errors', 'on');
// session_start();
require('../Complete/getTask.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク管理</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<div id="wrapper">
    <?php require('../header.php'); ?>
    <div id="content">
        <div class="main">
            <div class="box">
                <div class="uncomplete-button"><a href="../index">未完了</a></div>
                <div class="complete-button"><a class="complete" href="">完了</a></div>
            </div>
            <div class="task-search">
                <form action="user_list.php" method="post">
                    <input type="text" class="form" placeholder="キーワードを入力" name="">
                    <input type="submit" class="button" value="検索">
                </form>
            </div>
            <h2 class="title">完了タスク一覧</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th class="task-name">タスク名</th>
                        <th class="dead-line">締め切り</th>
                        <th>カテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataLists as $dataList) : ?>
                        <tr>
                            <td class="contents"><?php echo $dataList['contents']; ?></td>
                            <td><?php echo $dataList['deadline']; ?></td>
                            <td><?php echo $dataList['name']; ?></td>
                            <td><a class="botann1" href="edit.php?id=<?php echo $dataList['id']; ?>">未完了</a></td>
                            <td><a class="botann2" href="edit.php?id=<?php echo $dataList['id']; ?>">編集</a></td>
                            <td><a class="botann3" href="delete.php?id=<?php echo $dataList['id']; ?>">削除</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php require('../footer.php'); ?>
</div>

</html>