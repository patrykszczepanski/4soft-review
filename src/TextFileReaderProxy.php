<?php

namespace App;


use Exception;

class TextFileReaderProxy implements TextFileReaderInterface
{
    private TextFileReader $textFileReader;
    private ?string $tempFilePath = null;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly string $filePath
    ) {
        if (file_exists($this->filePath)) {
            $this->textFileReader = new TextFileReader($this->filePath);
        } else {
            if($this->downloadFileFromInternet($this->filePath)) {
                $this->textFileReader = new TextFileReader($this->tempFilePath);
            } else {
                throw new Exception('Unable to find a file locally and using proxy');
            }
        }
    }

    public function __destruct()
    {
        if($this->tempFilePath != null) {
            unlink($this->tempFilePath);
        }
    }

    public function readLine(): ?string
    {
        return $this->textFileReader->readLine();
    }

    private function downloadFileFromInternet(string $filePath): bool
    {
        /*
         * For demonstration purposes, let's create a temporary file with sample data.
         */

        // Sample data to simulate file content downloaded from the internet
        $fileContent = "Line 1\nLine 2\nLine 3";

        // Create a temporary file to save the downloaded content
        $this->tempFilePath = tempnam(sys_get_temp_dir(), 'tempFile');
        file_put_contents($this->tempFilePath, $fileContent);

        // return true as long as it's just for demonstration purposes and there is no case to not locate file online
        return true;
    }
}