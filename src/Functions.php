<?php

namespace Src;

/**
 * Class created with enhanced features.
 *
 * @copyright Copyright © 2022 Walter Luis
 * @license   MIT
 * @author    Walter Luis <walterluisglez@gmail.com>
 */
class Functions
{
    /**
     * Changes file mode.
     *
     * @param string $pathToTheFile
     * @param integer $permissions
     * @return boolean
     *
     * @link https://php.net/manual/en/function.chmod.php
     */
    public static function chmod(string $pathToTheFile, int $permissions = 0644): bool
    {
        if (false === \file_exists($pathToTheFile) && false === \is_dir($pathToTheFile)) {
            return false;
        }

        return \chmod($pathToTheFile, $permissions);
    }
}
