<!DOCTYPE html>
<html>
<div id="header">
    <div class="header-list">
        <ul>
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="../logout.php">ログアウト</a></li>
            <?php else : ?>
                <li><a href="../signin.php">ログイン</a></li>
            <?php endif; ?>
            <li><a href="../Category/index.php">カテゴリー覧</a></li>
            <li>
                <div class="task-search">
                    <form action="searchTask.php" method="post">
                        <input type="text" class="form" name="searchWord" placeholder="タスクを探す">
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>

</html>