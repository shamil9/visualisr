<?php

// https://stackoverflow.com/questions/1653771/how-do-i-remove-a-directory-that-is-not-empty
function deleteDirectory($dir)
{
    if (! file_exists($dir)) {
        return true;
    }

    if (! is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (! deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
