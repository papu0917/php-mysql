<?php
session_start();
// require('getTask.php');
require('getCategories.php');

$category_id = $_GET['id'];

$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$stmt = $pdo->prepare("select * from categories where categories.id = :category_id");
$stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
$res = $stmt->execute();
$category = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>カテゴリー編集</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper">
        <div id="tasks">
            <?php require('../header.php'); ?>
            <div class="index">
                <form action="update.php" method="post">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <div class="box">
                        <input class="box-001" type="text" name="category_name" value="<?php echo $category['name']; ?>" />
                    </div>
                    <input class="input" type="submit" value="更新" />
                </form>
                <div class="box-003"><a href="index.php">戻る</a></div>
            </div>
        </div>

        <?php require('../footer.php'); ?>
    </div>
</body>

</html>