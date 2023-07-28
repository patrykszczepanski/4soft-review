<?php

namespace Tests;

use App\Solution1\TextFileReaderProxy;
use App\Solution1\UnixEOLConverterDecorator;
use PHPUnit\Framework\TestCase;

use Exception;

class TextFileReaderProxyTest extends TestCase
{
    private string $testFilePath;
    private string $testFileContent;

    protected function setUp(): void
    {
        // Create a temporary test file with sample content
        $this->testFileContent = "Line 1\nLine 2\nLine 3";
        $this->testFilePath = tempnam(sys_get_temp_dir(), 'testFile');
        file_put_contents($this->testFilePath, $this->testFileContent);
    }

    protected function tearDown(): void
    {
        // Clean up the temporary test file
        unlink($this->testFilePath);
    }

    public function testReadLineWithLocalFile()
    {
        $proxy = new TextFileReaderProxy($this->testFilePath);

        // Read lines from the local file and compare with expected data
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];
        foreach ($expectedLines as $expectedLine) {
            $this->assertEquals($expectedLine, $proxy->readLine());
        }

        // After reading all lines, the next read should return null
        $this->assertNull($proxy->readLine());
    }

    public function testReadLineWithRemoteFile()
    {
        // For this test, we'll simulate the download and use a temporary file
        $tempRemoteFilePath = tempnam(sys_get_temp_dir(), 'remoteTestFile');
        file_put_contents($tempRemoteFilePath, $this->testFileContent);

        $proxy = new TextFileReaderProxy($tempRemoteFilePath);

        // Read lines from the temporary remote file and compare with expected data
        $expectedLines = ['Line 1\n', 'Line 2\n', 'Line 3'];
        foreach ($expectedLines as $expectedLine) {
            echo $expectedLine.' - '.$proxy->readLine();
            $this->assertEquals($expectedLine, $proxy->readLine());
        }

        // After reading all lines, the next read should return null
        $this->assertNull($proxy->readLine());

        // Clean up the temporary remote file
        unlink($tempRemoteFilePath);
    }
}