<?php

namespace Framework\Collections;

use Closure;

class Collection
{
    public $collection = array();

    public function collect(array $array)
    {
        $this->collection = $array;
        return $this;
    }

    public function push(array $payload)
    {
        foreach($payload as $index => $value)
        {
            $this->collection[$index] = $value;
        }
        return $this;
    }

    public function pushLast($payload)
    {
        array_push($this->collection, $payload);
        return $this;
    }

    public function pushFirst($payload)
    {
        array_unshift($this->collection, $payload);
        return $this;
    }

    public function searchKey($key)
    {
        $this->collection = array_search($key, $this->collection);
        return $this;
    }

    public function getKeys()
    {
        $this->collection = array_keys($this->collection);
        return $this;
    }

    public function getValues()
    {
        $this->collection = array_values($this->collection);
        return $this;
    }

    public function toJson()
    {
        return json_encode($this->collection, JSON_FORCE_OBJECT);
    }

}
