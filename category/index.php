<?php
require_once(__DIR__ . '/../Session.php');
$session = Session::getInstance();
$errors = $session->loadErrorsWithDestory();

require('getCategories.php');
// require('../getTask.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="../css/style.css">
</head>


<body>
    <div id="wrapper">
        <?php require('../header.php'); ?>
        <div id="category">
            <div class="content">
                <h2>カテゴリ一覧</h2>
                <div class="index">
                    <form action="createComplete.php" method="post">
                        <input class="width input" type="text" name="name" placeholder="カテゴリー追加" />
                        <button class="submit">登録</button>
                        <div class="error-messages">
                            <span class="error-message"></span>
                        </div>
                    </form>
                </div>
                <div class=" table">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>

                    <table class="table-list">
                        <?php foreach ($categories as $category) : ?>
                            <tr class="category">
                                <td><?php echo $category['name']; ?></td>
                                <td><a class="botann1" href="edit.php?id=<?php echo $category['id']; ?>">編集</a></td>
                                <td>
                                    <form action="delete.php" method="post">
                                        <input type="submit" class="botann2" name="delete" value="削除" />
                                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <a class="botann" href="../index.php">戻る</a>
        </div>
        <?php require('../footer.php'); ?>
    </div>
    <script>
        const btn = document.querySelector('.submit');
        btn.addEventListener('click', async function(event) {
            // デフォルトのサブミットを止める
            event.preventDefault();

            const nameInput = document.querySelector('.input');
            const name = nameInput.value;
            // APIを叩くための準備
            const obj = {
                name,
            };
            const body = JSON.stringify(obj);
            const headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            };
            // APIを叩く.デフォルトはGET
            const response = await fetch(
                '/Api/Category/createComplete.php', {
                    method: "POST",
                    headers,
                    body
                });
            const json = await response.json();
            console.log('response', response);
            console.log('json', json);

            if (json.status) {
                // alert(json.message);
                nameInput.value = "";
                // const data = json.data; 下と同じ
                // const { data } = json; 
                // const { id, name } = data; 
                const {
                    data: {
                        id,
                        name
                    }
                } = json;

                const message = document.querySelector('.category');
                // location.href = "/Category/index.php";
                appendCategoryTr(id, name);
            } else {
                const errorMessage = document.querySelector('.error-message');
                errorMessage.innerHTML = json.message;
            }
        }, false);

        function appendCategoryTr(categoryId, categoryName) {
            const tr = document.createElement('tr');
            tr.classList.add('category');

            const nameTd = document.createElement('td');
            nameTd.textContent = categoryName;

            const editTd = document.createElement('td');
            const editA = document.createElement('a');
            editA.href = 'edit.php?id=' + categoryId;
            editA.textContent = '編集';
            editA.classList.add('botann1');
            editTd.appendChild(editA);

            const deleteTd = document.createElement('td');
            const deleteA = document.createElement('a');
            deleteA.href = 'delete.php?id=' + categoryId;
            deleteA.textContent = '削除';
            deleteA.classList.add('botann2');
            deleteTd.appendChild(deleteA);

            tr.appendChild(nameTd);
            tr.appendChild(editTd);
            tr.appendChild(deleteTd);

            const tbody = document.querySelector('.table-list tbody');
            tbody.appendChild(tr);
        }
    </script>
</body>

</html>