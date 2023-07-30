<?php

namespace App;

interface FileReadStrategyInterface
{
    public function readFile(string $filePath): string;
}