<?php

namespace App\Solution1;
interface FileReadingStrategyInterface
{
    public function readLines(): string;
}