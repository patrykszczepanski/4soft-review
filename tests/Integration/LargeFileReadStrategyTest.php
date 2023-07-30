<?php

namespace Tests\Integration;

use App\LargeFileReadStrategy;
use PHPUnit\Framework\TestCase;

class LargeFileReadStrategyTest extends TestCase
{
    public function testReadFile()
    {
        // Create temporary file with test content
        $filePath = tempnam(sys_get_temp_dir(), 'testFile');
        $fileContent = "Line 1\nLine 2\nLine 3";
        file_put_contents($filePath, $fileContent);

        // Create instance of LargeFileReadStrategy
        $strategy = new LargeFileReadStrategy();
        $result = $strategy->readFile($filePath);

        $this->assertEquals($fileContent, $result);

        // Clean up
        unlink($filePath);
    }
}