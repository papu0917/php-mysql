<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>エラー</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <ul class="error_list">
        <?php foreach ($messages as $value) : ?>
            <li><?php echo $value; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>