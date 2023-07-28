<?php

namespace Tests;

use App\Solution1\TextFileReader;
use PHPUnit\Framework\TestCase;

class TextFileReaderTest extends TestCase
{
    public function testReadLineWithInvalidFilePath()
    {
        // Assert that an exception to type \Exception will be thrown
        $this->expectException(\Exception::class);

        // Attempt to create an instance of the FileReader class with an invalid file path
        new TextFileReader("invalid_path.txt");

        // The code should never reach this point due to the exception
        $this->fail("The FileReader class should have thrown an exception for an invalid file path.");
    }

    public function testReadFile()
    {
        // Define a test text file content with newlines
        $testContent = "Line 1\nLine 2\nLine 3";
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];

        // Create a temporary file with the test content
        $filePath = tempnam(sys_get_temp_dir(), 'file_windows');
        file_put_contents($filePath, $testContent);

        // Instantiate the TextFileReader
        $textFileReader = new TextFileReader($filePath);

        // Read the lines one by one and check if they match the expected content
        foreach ($expectedLines as $expectedLine) {
            $this->assertSame($expectedLine, $textFileReader->readLine());
        }

        // After reading all lines, an additional read should return null, indicating the end of the file
        $this->assertNull($textFileReader->readLine());

        // Clean up by deleting the temporary file
        unlink($filePath);
    }
}