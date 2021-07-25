<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク追加</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="tasks">
        <div class="index">
            <form action="createComplete.php" method="post">
                <input class="width" type="text" name="contents" placeholder="タスクを追加" />
                <input class="" type="date" name="deadline" placeholder="" />
                <input class="input" type="submit" value="追加" />
            </form>
        </div>
        <a href="index.php">戻る</a>
    </div>
</body>

</html>