<?php

namespace App\Solution1;

use Exception;

class TextFileReader implements TextFileReaderInterface
{
    private mixed $fileHandle;

    /**
     * @throws Exception
     */
    public function __construct(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("File doesn't exist.");
        }
        $this->fileHandle = fopen($filePath, 'r');
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    public function readLine(): ?string
    {
        $line = fgets($this->fileHandle);
        if ($line === false) {
            return null;
        }

        return preg_replace("/\n/m", '\n', $line);
    }
}