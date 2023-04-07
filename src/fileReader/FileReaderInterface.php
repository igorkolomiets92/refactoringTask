<?php

namespace fileReader;

interface FileReaderInterface
{
    public function read(string $url): string;
}