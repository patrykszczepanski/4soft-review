<?php

namespace Tests\Integration;

use App\SmallFileReadStrategy;
use PHPUnit\Framework\TestCase;

class SmallFileReadStrategyTest extends TestCase
{
    public function testReadFile()
    {
        // Create temporary file with test content
        $fileContent = "Line 1\nLine 2\nLine 3";
        $filePath = tempnam(sys_get_temp_dir(), 'testFile');
        file_put_contents($filePath, $fileContent);

        // Create instance of SmallFileReadStrategy
        $strategy = new SmallFileReadStrategy();
        $result = $strategy->readFile($filePath);

        $this->assertEquals($fileContent, $result);

        // Clean up
        unlink($filePath);
    }
}