<?php

namespace App\Support;

class Collection implements \IteratorAggregate, \JsonSerializable
{
    protected array $items = array();

    public function __construct(array $items = array())
    {
        $this->items = $items;
    }

    public function get(): array
    {
        return $this->items;
    }

    public function count() : int
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function merge(Collection $collection)
    {
        return $this->add($collection->get());
    }

    public function add(array $items)
    {
        return $this->items = array_merge($this->items, $items);
    }

    public function toJson()
    {
        try {
            return json_encode($this->items, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}