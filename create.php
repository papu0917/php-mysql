<?php
session_start();
$errorMessages = $_SESSION['errorMessages'] ?? [];
$formInputs = $_SESSION['formInputs'] ?? [];
unset($_SESSION['errorMessages'], $_SESSION['formInputs']);
require('getTask.php');
require('Category/getCategories.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク追加</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="wrapper">
        <div id="tasks">
            <?php require('./header.php'); ?>
            <div class="index">
                <?php if (!empty($errorMessages)) : ?>
                    <ul class="error_list">
                        <?php foreach ($errorMessages as $errorMessage) : ?>
                            <li><?php echo $errorMessage; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="createComplete.php" method="post">
                    <div class="box">
                        <input class="box-001" type="text" name="contents" placeholder="タスクを追加" value="<?php echo $formInputs['contents'] ?? ''; ?>" />
                    </div>
                    <div class="box">
                        <input class="box-002" type="date" name="deadline" placeholder="" value="<?php echo $formInputs['deadline'] ?? ''; ?>" />
                    </div>
                    <div class="box">
                        <select name="category">
                            <?php foreach ($categories as $category) : ?>
                                <?php echo '<option value="', $category['id'], '">', $category['name'], '</option>'; ?>
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