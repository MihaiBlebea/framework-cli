<?php

namespace Framework\Interfaces;

interface LoggerInterface
{
    public static function log($payload);

    public static function checkOrCreateFile($file);
}
