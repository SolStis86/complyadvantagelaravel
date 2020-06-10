<?php


namespace SolStis86\ComplyAdvantage;


use Closure;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient\SearchRequest;

class ApiClient
{
    protected $http;

    public function __construct()
    {
        $this->http = Http::withToken(config('complyadvantage.api_key', null), 'Token')
            ->withOptions([
                'base_uri' => 'https://api.complyadvantage.com',
            ]);
    }

    /**
     * @param SearchRequest $request
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function createSearch(SearchRequest $request)
    {
        $response = $this->http->post('searches', $request->toArray());

        return $response->json();
    }

    public function handleResponse(Response $response)
    {

    }
}
