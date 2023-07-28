<?php

namespace Tests;

use App\Solution1\UnixEOLConverterDecorator;
use PHPUnit\Framework\TestCase;

use Exception;

class UnixEOLConverterDecoratorTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testTransformUnixLine()
    {
        // Define a test text file content with newlines
        $testContent = "Line 1\r\nLine 2\r\nLine 3";
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];

        // Create a temporary file with the test content
        $filePath = tempnam(sys_get_temp_dir(), 'file');
        file_put_contents($filePath, $testContent);

        // Instantiate the TextFileReader
        $textFileReader = new UnixEOLConverterDecorator($filePath);

        // Read the lines one by one and check if they match the expected content
        foreach ($expectedLines as $expectedLine) {
            $actualLine = $textFileReader->readLine();
            $this->assertSame($expectedLine, $actualLine);
        }

        // After reading all lines, an additional read should return null, indicating the end of the file
        $this->assertNull($textFileReader->readLine());

        // Clean up by deleting the temporary file
        unlink($filePath);
    }
}