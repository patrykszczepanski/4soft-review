<?php

namespace Tests\Integration;

use App\TextFileReaderProxy;
use Exception;
use PHPUnit\Framework\TestCase;

class TextFileReaderProxyTest extends TestCase
{
    public function testReadLineWithLocalFile()
    {
        // Create a temporary test file with sample content
        $testFilePath = tempnam(sys_get_temp_dir(), 'testFile');
        file_put_contents($testFilePath, "Line 1\nLine 2\nLine 3");

        // Initiate proxy
        $proxy = new TextFileReaderProxy($testFilePath);

        // Read the lines one by one and check if they match the expected content
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];
        foreach ($expectedLines as $expectedLine) {
            $this->assertEquals($expectedLine, $proxy->readLine());
        }

        // After reading all lines, the next read should return null
        $this->assertNull($proxy->readLine());

        // Clean up
        unlink($testFilePath);
    }

    /**
     * @throws Exception
     */
    public function testReadLineWithRemoteFile()
    {
        $proxy = new TextFileReaderProxy("notExistentFile");

        // Read the lines one by one and check if they match the expected content
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];
        foreach ($expectedLines as $expectedLine) {
            $this->assertEquals($expectedLine, $proxy->readLine());
        }

        // After reading all lines, the next read should return null
        $this->assertNull($proxy->readLine());
    }
}