<?php

final class Redirect
{
    public static function handler(string $path)
    {
        header("Location" . $path);
        die;
    }
}
