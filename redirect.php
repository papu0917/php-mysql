<?php

function redirectIndex()
{
    header('Location: /index.php');
}

function redirectSignIn(): void
{
    header('Location: /signin.php');
}

function redirectCategoryIndex(): void
{
    header('Location: /category/index.php');
}

function redirectSearchResult()
{
    header('Location: /searchResult.php');
}
