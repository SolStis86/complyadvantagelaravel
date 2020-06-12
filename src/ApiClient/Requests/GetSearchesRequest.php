<?php


namespace SolStis86\ComplyAdvantage\ApiClient\Requests;


use SolStis86\ComplyAdvantage\ApiClient\ParameterBag;

class GetSearchesRequest extends ParameterBag
{
    protected $allowedParams = [
        'assignee_id',
        'searcher_id',
        'risk_level',
        'submitted_term',
        'match_status',
        'search_term',
        'created_at_from',
        'created_at_to',
        'tags',
        'sort_by',
        'sort_dir',
        'per_page',
        'page',
    ];

    protected $validationRules = [
        'assignee_id' => [
            'sometimes',
        ],
        'searcher_id' => [
            'sometimes',
        ],
        'risk_level' => [
            'sometimes',
        ],
        'submitted_term' => [
            'sometimes',
        ],
        'match_status' => [
            'sometimes',
        ],
        'search_term' => [
            'sometimes',
        ],
        'created_at_from' => [
            'sometimes',
        ],
        'created_at_to' => [
            'sometimes',
        ],
        'tags' => [
            'sometimes',
        ],
        'sort_by' => [
            'sometimes',
        ],
        'sort_dir' => [
            'sometimes',
        ],
        'per_page' => [
            'sometimes',
            'integer',
        ],
        'page' => [
            'sometimes',
            'integer',
        ],
    ];


    public static function make(): self
    {
        return new static();
    }
}
