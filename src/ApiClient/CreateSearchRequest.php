<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


use Illuminate\Contracts\Support\Arrayable;
use RuntimeException;
use SolStis86\ComplyAdvantage\Contracts\CreateSearchParamsI;
use SolStis86\ComplyAdvantage\Contracts\SearchParams;

/**
 * Class CreateSearchRequest
 *
 *
 * @link https://docs.complyadvantage.com/api-docs/#create-searches-post
 */
class CreateSearchRequest
    extends ParameterBag
    implements SearchParams, Arrayable
{
    protected $allowedParams = [
        'filters',
        'search_term',
        'client_ref',
        'search_profile',
        'fuzziness',
        'offset',
        'limit',
        'tags',
        'share_url',
        'exact_match',
        'country_codes',
    ];

    protected $validationRules = [
        'search_term' => [
            'required',
            'string',
        ],
        'client_ref' => [
            'sometimes',
        ],
        'search_profile' => [
            'sometimes',
        ],
        'fuzziness' => [],
        'offset' => [],
        'limit' => [],
        'tags' => [],
        'share_url' => [],
        'exact_match' => [],
        'country_codes' => [],
        'filters' => [],
    ];

    public static function make(string $searchTerm): self
    {
        return new static($searchTerm);
    }

    public function __construct(string $searchTerm)
    {
        $this->search_term = $searchTerm;
    }

    public function setFilters(SearchFilters $filters)
    {
        $this->filters = $filters->toArray();

        return $this;
    }
}
