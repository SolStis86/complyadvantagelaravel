<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


use SolStis86\ComplyAdvantage\Contracts\SearchFilterEntities;
use SolStis86\ComplyAdvantage\Contracts\SearchFilterTypes;

class SearchFilters
    extends ParameterBag
    implements SearchFilterEntities, SearchFilterTypes
{
    protected $allowedParams = [
        'types',
        'birth_year',
        'remove_deceased',
        'country_codes',
        'entity_type',
    ];

    protected $validationRules = [
        'types' => [
            'sometimes',
            'array',
        ],
        'types.*' => [
            'sometimes',
            'ca:types',
        ],
        'birth_year' => [
            'sometimes',
            'integer',
        ],
        'remove_deceased' => [
            'sometimes',
            'boolean',
        ],
        'country_codes' => [
            'sometimes',
            'array',
        ],
        'country_codes.*' => [
            'sometimes',
            'string',
        ],
        'entity_type' => [
            'sometimes',
            'ca:entities',
        ],
    ];

    public static function make()
    {
        return new static();
    }

    public function removeDeceased()
    {
        $this->remove_deceased = 1;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    public function setEntityType(string $entity)
    {
        $this->entity_type = $entity;

        return $this;
    }
}
