<?php
session_start();
$errorMessages = $_SESSION['errorMessages'] ?? [];
$formInputs = $_SESSION['formInputs'] ?? [];
unset($_SESSION['errorMessages'], $_SESSION['formInputs']);

require('getTask.php');
require('Category/getCategories.php');

$taskId = $_GET['id'];
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$stmt = $pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where tasks.id = :taskId");
$stmt->bindValue(':taskId', $taskId, PDO::PARAM_INT);
$res = $stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク編集</title>
    <link rel="stylesheet" href="../css/style.css">
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

                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $taskId; ?>">
                    <div class="box">
                        <input class="box-001" type="text" name="contents" value="<?php echo $data['contents']; ?>" />
                    </div>
                    <div class="box">
                        <input class="box-002" type="date" name="deadline" value="<?php echo $data['deadline']; ?>" />
                    </div>
                    <div class="box">
                        <select name="category">
                            <?php foreach ($categories as $category) : ?>
                                <?php echo '<option value="', $category['id'], '">', $category['name'], '</option>'; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input class="input" type="submit" value="更新" />
                </form>
                <div class="box-003"><a href="index.php">戻る</a></div>
            </div>

        </div>

        <?php require('./footer.php'); ?>
    </div>
</body>

</html>