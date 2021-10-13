<?php
ini_set('display_errors', 'on');
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/Category/getCategories.php');
$session = Session::getInstance();

require_once __DIR__ . '/Interfaces/Repository/TaskMySqlRepository.php';
require_once __DIR__ . '/Domain/ValueObject/UserId.php';

$userId = $_SESSION['id'];
$taskId = new TaskId($userId);
$taskRepositroy = new TaskMySqlRepository();
$incompleteTasks = $taskRepositroy->findAllByUserId($taskId);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク管理</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<div id="wrapper">
    <?php require('header.php'); ?>
    <div id="content">
        <div class="main">
            <div class="box">
                <div class="uncomplete-button"><a href="">未完了</a></div>
                <div class="complete-button"><a class="complete" href="../complete/index.php">完了</a></div>
            </div>



            <form action="createComplete.php" method="post">
                <div class="box">
                    <input class="box-001 contents" type="text" name="contents" placeholder="タスクを追加" value="<?php echo $formInputs['contents'] ?? ''; ?>" />
                </div>
                <div class="box">
                    <input class="box-002 deadline" type="date" name="deadline" placeholder="" value="<?php echo $formInputs['deadline'] ?? ''; ?>" />
                </div>
                <div class="box">
                    <select name="category" class="category">
                        <?php foreach ($categories as $category) : ?>
                            <?php echo '<option value="', $category['id'], '">', $category['name'], '</option>'; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="insert">追加</button>
            </form>




            <h2 class="title">未完了タスク一覧</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th class="task-name">タスク名</th>
                        <th class="dead-line">締め切り</th>
                        <th>カテゴリー</th>
                        <th><a class="botann" href="ascendingOrder.php">締切昇順</a></th>
                        <th><a class="botann" href="descendingOrder.php">締切降順</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incompleteTasks as $incompleteTask) : ?>
                        <tr>
                            <td class="contents"><?php echo $incompleteTask->contents()->value(); ?></td>
                            <td>
                                <?php
                                if ($incompleteTask->isOverDeadline()) {
                                    $deadlineClass = 'deadline-color';
                                } else {
                                    $deadlineClass = '';
                                }
                                ?>
                                <div class="<?php echo $deadlineClass; ?>">
                                    <?php echo $incompleteTask->deadline()->format("Y-m-d") ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($incompleteTask->hasCategory()) : ?>
                                    <a href="searchCategory.php?name=<?php echo $incompleteTask->categoryName(); ?>"><?php echo $incompleteTask->categoryName(); ?></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action=" updateStatus.php" method="post">
                                    <input type="submit" class="botann1" name="id" value="完了" />
                                    <input type="hidden" name="id" value="<?php echo $incompleteTask->id()->value(); ?>">
                                </form>
                            </td>
                            <td><a class="botann2" href="edit.php?id=<?php echo $incompleteTask->id()->value(); ?>">編集</a></td>
                            <td>
                                <form action="delete.php" method="post">
                                    <input type="submit" class="botann3" name="id" value="削除" />
                                    <input type="hidden" name="id" value="<?php echo $incompleteTask->id()->value(); ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require('footer.php'); ?>
</div>

<script>
    const btn = document.querySelector('.insert');
    btn.addEventListener('click', async function(event) {
        // デフォルトのサブミットを止める
        event.preventDefault();

        const contentsInput = document.querySelector('.contents');
        const contents = contentsInput.value;

        const deadlineInput = document.querySelector('.deadline');
        const deadline = deadlineInput.value;

        const categoryInput = document.querySelector('.category');
        const categoryId = categoryInput.value;

        // APIを叩くための準備
        const obj = {
            contents,
            deadline,
            categoryId,
        };
        const body = JSON.stringify(obj);
        const headers = {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        };
        // APIを叩く.デフォルトはGET
        const response = await fetch(
            '/Api/Task/createComplete.php', {
                method: "POST",
                headers,
                body
            });
        const json = await response.json();
        console.log('response', response);
        console.log('json', json);
    }, false);
</script>

</html>