<?php

namespace App;

interface TextFileReaderInterface
{
    public function readLine(): ?string;
}