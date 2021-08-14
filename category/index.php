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
    <link rel="stylesheet" href="../css/style.css">
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
                            <td><a class="botann1" href="edit.php?id=<?php echo $category['id']; ?>">編集</a></td>
                            <td>
                                <form action="delete.php" method="post">
                                    <input type="submit" class="botann2" name="delete" value="削除" />
                                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                </form>
                            </td>
                            <!-- <td><a class="botann2" href="delete.php?id=<?php echo $category['id']; ?>">削除</a></td> -->
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <a class="botann" href="../index.php">戻る</a>
    </div>
    <?php require('../footer.php'); ?>
</div>

</html>