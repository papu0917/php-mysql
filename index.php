<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>タスク管理</title>
    <link rel="stylesheet" href="style.css">
</head>

<div id="wrapper">
    <div id="header">
        <div class="header-list">
            <ul>
                <li><a href="">ログアウト</a></li>
                <li><a href="">カテゴリー覧</a></li>
                <li><a href="">＋</a></li>
            </ul>
        </div>
    </div>
    <div id="content">
        <div class="content">
            <div class="main">
                <div class="box">
                    <div class="uncomplete-button"><a href="">未完了</a></div>
                    <div class="complete-button"><a class="complete" href="">完了</a></div>
                </div>
                <div class="task-search">
                    <form action="user_list.php" method="post">
                        <input type="text" class="form" placeholder="キーワードを入力" name="">
                        <input type="submit" class="button" value="検索">
                    </form>
                </div>
                <h2 class="title">未完了タスク一覧</h2>
                <div class="vertical-scroll-table">
                    <table>
                        <thead>
                            <tr>
                                <th>果物</th>
                                <th>野菜</th>
                                <th>価格</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>リンゴ</td>
                                <td>トマト</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>みかん</td>
                                <td>キュウリ</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>もも</td>
                                <td>キャベツ</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td>スイカ</td>
                                <td>人参</td>
                                <td>400</td>
                            </tr>
                            <tr>
                                <td>オレンジ</td>
                                <td>大根</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>ぶどう</td>
                                <td>レタス</td>
                                <td>600</td>
                            </tr>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</html>