<?php

namespace Framework\Log;

use Framework\Interfaces\LoggerInterface;

class PaymentLogger implements LoggerInterface
{
    private static $filePath =  __LOG_PATH__;
    private static $fileName = "payment.txt";

    public static function log($payload)
    {
        $date = date("Y-m-d");

        $txt = "";
        foreach($payload as $key => $value)
        {
            if(gettype($value) == "array")
            {
                $value = json_encode($value);
            }
            $txt .= $value . "\n";
        }
        $file = self::checkOrCreateFile(static::$filePath . $date . "_" . static::$fileName);

        fwrite($file, $txt);
        fclose($file);
    }

    public static function checkOrCreateFile($file)
    {
        return fopen($file, "a");
    }
}
