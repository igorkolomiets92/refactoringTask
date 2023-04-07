<?php

namespace fileReader;

class FileReader implements FileReaderInterface
{
    public function read(string $url): string
    {
        $content = file_get_contents($url);
        if ($content === false) {
            throw new \Exception('Unable to read file from URL');
        }
        return $content;
    }
}