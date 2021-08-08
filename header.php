<!DOCTYPE html>
<html>
<div id="header">
    <div class="header-list">
        <ul>
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">ログアウト</a></li>
            <?php else : ?>
                <li><a href="">ログイン</a></li>
            <?php endif; ?>
            <li><a href="../Category/index.php">カテゴリー覧</a></li>
            <li><a href="../create.php">＋</a></li>
        </ul>
    </div>
</div>

</html>