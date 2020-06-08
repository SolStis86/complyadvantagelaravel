<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use SolStis86\ComplyAdvantage\Contracts\SearchFilterEntities;
use SolStis86\ComplyAdvantage\Contracts\SearchFilterTypes;

abstract class ParameterBag implements Arrayable
{
    private $data = [];

    protected $allowedParams;

    protected $validationRules;

    public function toArray()
    {
        return collect($this->allowedParams)
            ->filter(function ($param) {
                return isset($this->data[$param]);
            })
            ->mapWithKeys(function ($param) {
                return [$param => $this->data[$param]];
            })
            ->toArray();
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (false === $this->isAllowedParam($name)) {
            throw new RuntimeException("Create search parameter ${name} not allowed.");
        }

        $this->data[$name] = $value;

        $this->validate();
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (false === $this->isAllowedParam($name)) {
            throw new RuntimeException("Create search parameter ${name} not allowed.");
        }

        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function isAllowedParam($name): bool
    {
        return in_array($name, $this->allowedParams);
    }

    public function setParams(array $params)
    {
        collect($params)->each(function ($val, $key) {
            $this->{$key} = $val instanceof Arrayable ? $val->toArray() : $val;
        });

        $this->validate();

        return $this;
    }

    public function validate()
    {
        $validator = validator($this->toArray(), $this->validationRules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this;
    }
}
