<?php

function redirectIndex(): void
{
    header('Location: /index.php');
}

function redirectCategoryIndex(): void
{
    header('Location: /category/index.php');
}
