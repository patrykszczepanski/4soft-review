<?php

namespace App;

class SmallFileReadStrategy implements FileReadStrategyInterface
{
    public function readFile(string $filePath): string
    {
        // Read the entire small file into memory
        return file_get_contents($filePath);
    }
}