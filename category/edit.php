<?php
session_start();
require_once __DIR__ . '/..//Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';

$id = $_GET['id'];
$categoryId = new CategoryId($id);
$categoryRepositroy = new CategoryMySqlRepository();
$category = $categoryRepositroy->findById($categoryId);
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
                    <input type="hidden" name="category_id" value="<?php echo $categoryId->value(); ?>">
                    <div class="box">
                        <input class="box-001" type="text" name="category_name" value="<?php echo $category->name()->value(); ?>" />
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