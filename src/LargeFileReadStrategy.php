<?php

namespace App;

class LargeFileReadStrategy implements FileReadStrategyInterface
{
    public function readFile(string $filePath): string
    {
        $result = '';
        $fileHandle = fopen($filePath, 'r');
        if ($fileHandle) {
            while (($line = fgets($fileHandle)) !== false) {
                $result .= $line;
            }
            fclose($fileHandle);
        }
        return $result;
    }
}