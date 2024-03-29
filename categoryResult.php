<?php
ini_set('display_errors', 'on');
require_once(__DIR__ . '/Dao/TaskDao.php');
require_once(__DIR__ . '/Session.php');

$session = Session::getInstance();
$userId = $_SESSION['id'];
$name = $_GET['name'];
$taskDao = new TaskDao();
$categories = $taskDao->findByCategoryName($userId, $name);
var_dump($categories);
die;

require('getTask.php');
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
			<div class="task-search">
				<form action="searchTask.php" method="post">
					<input type="text" class="form" name="searchWord" placeholder="キーワードを入力">
					<input type="submit" class="button" value="検索">
				</form>
			</div>
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
							<td class="contents"><?php echo $incompleteTask['contents']; ?></td>
							<td><?php echo $incompleteTask['deadline']; ?></td>
							<td><a href="searchCategory.php?id=<?php echo $incompleteTask['name']; ?>"><?php echo $incompleteTask['name']; ?></a></td>
							<td>
								<form action=" updateStatus.php" method="post">
									<input type="submit" class="botann1" name="id" value="完了" />
									<input type="hidden" name="id" value="<?php echo $incompleteTask['id']; ?>">
								</form>
							</td>
							<td><a class="botann2" href="edit.php?id=<?php echo $incompleteTask['id']; ?>">編集</a></td>
							<td>
								<form action="delete.php" method="post">
									<input type="submit" class="botann3" name="id" value="削除" />
									<input type="hidden" name="id" value="<?php echo $incompleteTask['id']; ?>">
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

</html>