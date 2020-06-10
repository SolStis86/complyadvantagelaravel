<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


use Illuminate\Contracts\Support\Arrayable;
use Stringable;

abstract class DataBag implements Stringable, Arrayable
{
    protected $data;

    public static function make(array $data)
    {
        return new static($data);
    }

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function has($path): bool
    {
        return (bool) data_get($this->data, $path, false);
    }

    public function __get($name)
    {
        return data_get($this->data, $name, null);
    }

    public function __toString()
    {
        return json_encode($this->data);
    }

    public function serialize()
    {
        return serialize($this->data);
    }

    public function toArray()
    {
        return $this->data;
    }
}
