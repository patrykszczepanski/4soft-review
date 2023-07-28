<?php

namespace App\Solution1;

interface TextFileReaderInterface
{
    public function readLine(): ?string;
}