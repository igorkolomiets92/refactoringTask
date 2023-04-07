<?php

namespace fileReader;

class FileReader implements FileReaderInterface
{
    /**
     * @throws \Exception
     */
    public function read(string $url): string
    {
        $content = file_get_contents($url);
        if ($content === false) {
            throw new \Exception('Unable to read file from URL');
        }
        return $content;
    }
}