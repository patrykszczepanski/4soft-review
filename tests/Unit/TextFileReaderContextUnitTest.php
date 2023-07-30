<?php

namespace Tests\Unit;

use App\LargeFileReadStrategy;
use App\SmallFileReadStrategy;
use App\TextFileReaderContext;
use PHPUnit\Framework\TestCase;

class TextFileReaderContextUnitTest extends TestCase
{
    private string $testFilePath;
    private string $testFileContent;

    protected function setUp(): void
    {
        // Create a temporary text file
        $this->testFileContent = "Line 1\nLine 2\nLine 3";
        $this->testFilePath = tempnam(sys_get_temp_dir(), 'testFile');
        file_put_contents($this->testFilePath, $this->testFileContent);
    }

    protected function tearDown(): void
    {
        // Delete temporary file
        unlink($this->testFilePath);
    }

    public function testReadWithSmallFileStrategy()
    {
        $smallFileStrategy = $this->getMockBuilder(SmallFileReadStrategy::class)
            ->getMock();
        $smallFileStrategy->expects($this->once())
            ->method('readFile')
            ->with($this->testFilePath)
            ->willReturn($this->testFileContent);

        $context = new TextFileReaderContext($smallFileStrategy);
        $result = $context->read($this->testFilePath);

        $this->assertEquals($this->testFileContent, $result);
    }

    public function testReadWithLargeFileStrategy()
    {
        $largeFileStrategy = $this->getMockBuilder(LargeFileReadStrategy::class)
            ->getMock();
        $largeFileStrategy->expects($this->once())
            ->method('readFile')
            ->with($this->testFilePath)
            ->willReturn($this->testFileContent);

        $context = new TextFileReaderContext($largeFileStrategy);
        $result = $context->read($this->testFilePath);

        $this->assertEquals($this->testFileContent, $result);
    }
}