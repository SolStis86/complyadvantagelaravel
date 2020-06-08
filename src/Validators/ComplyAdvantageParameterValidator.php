<?php


namespace SolStis86\ComplyAdvantage\Validators;


use ReflectionClass;
use SolStis86\ComplyAdvantage\Contracts\SearchFilterEntities;
use SolStis86\ComplyAdvantage\Contracts\SearchFilterTypes;

class ComplyAdvantageParameterValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        switch ($parameters[0]) {
            case 'types':
                return in_array($value, (new ReflectionClass(SearchFilterTypes::class))->getConstants());
            case 'entities':
                return in_array($value, (new ReflectionClass(SearchFilterEntities::class))->getConstants());
            default:
                return false;
        }
    }
}