<?php
// session_start();
require('getCategories.php');
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
        <?php foreach ($categories as $category) : ?>
            <?php echo $category['name']; ?>
        <?php endforeach; ?>
    </div>
</div>

</html>