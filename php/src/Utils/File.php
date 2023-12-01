<?php

namespace Akipe\AdventOfCode2023\Utils;

use Iterator;

class File implements Iterator
{
    private array $lines;
    private string $content;
    private int $index;

    public function __construct(
        private string $path,
    ) {
        $this->setContent();
        $this->setLines();
        $this->index = 0;
    }

    private function setContent(): void
    {
        $content = file_get_contents($this->path);

        if (!$content) {
            throw new \ErrorException("File at path \"". $this->path ."\" can't be open!");
        }

        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setLines(): void
    {
        $this->lines = explode(PHP_EOL, $this->content);
    }

    public function current(): mixed
    {
        return $this->lines[$this->index];
    }

    public function next(): void
    {
        $this->index++;
    }

    public function key(): mixed
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return $this->index < count($this->lines);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
