<?php

require('Category/getCategories.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク追加</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="wrapper">
        <div id="tasks">
            <?php require('./header.php'); ?>
            <div class="index">

                <form action="createComplete.php" method="post">
                    <div class="box">
                        <input class="box-001" type="text" name="contents" placeholder="タスクを追加" />
                    </div>
                    <div class="box">
                        <input class="box-002" type="date" name="deadline" placeholder="" />
                    </div>
                    <div class="box">
                        <select name="category">
                            <?php foreach ($categories as $value) : ?>
                                <?php echo '<option value="', $value['id'], '">', $value['name'], '</option>'; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input class="input" type="submit" value="追加" />
                </form>
                <div class="box-003"><a href="index.php">戻る</a></div>
            </div>

        </div>

        <?php require('./footer.php'); ?>
    </div>
</body>

</html>