<?php

namespace App\Helpers;

class Utility
{
    /**
     * Removes the given directory including all files inside
     * http://stackoverflow.com/a/1653776
     * @param  string $dir
     * @return boolean
     */
    static public function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }
}
