<?php

namespace App\Solution1;

class UnixEOLConverterDecorator extends TextFileReader
{
    public function __construct(string $filename)
    {
        parent::__construct($filename);
    }


    public function readLine(): ?string
    {
        $line = parent::readLine();
        if ($line === null) {
            return null;
        }

        // Convert EOL characters to Unix-style (LF)
        return str_replace(["\r\n", "\r"], '', $line);
    }
}