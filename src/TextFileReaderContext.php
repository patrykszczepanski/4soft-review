<?php

namespace App;

class TextFileReaderContext
{
    public function __construct(
        private readonly FileReadStrategyInterface $strategy
    ) {
    }

    public function read(string $filePath): string
    {
        return $this->strategy->readFile($filePath);
    }
}