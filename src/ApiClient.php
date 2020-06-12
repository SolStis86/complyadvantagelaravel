<?php


namespace SolStis86\ComplyAdvantage;


use Closure;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient\Requests\GetSearchesRequest;
use SolStis86\ComplyAdvantage\ApiClient\ResponseData;
use SolStis86\ComplyAdvantage\ApiClient\CreateSearchRequest;
use SolStis86\ComplyAdvantage\Exceptions\ComplyAdvantageApiException;

class ApiClient
{
    /**
     * @var PendingRequest
     */
    protected $http;

    public function __construct()
    {
        $this->http = Http::withToken(config('complyadvantage.api_key', null), 'Token')
            ->withOptions([
                'base_uri' => 'https://api.complyadvantage.com',
            ]);
    }

    /**
     * Retrieve previous searches on your account
     *
     * @link https://docs.complyadvantage.com/api-docs/#get-searches
     * @param GetSearchesRequest $request
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function getSearches(GetSearchesRequest $request)
    {
        return $this->handleResponse(
            $this->http->get('searches', $request->toArray())
        );
    }

    /**
     * Retrieve a previously created search
     *
     * @link https://docs.complyadvantage.com/api-docs/#get-searches-id
     * @param int $id
     * @param bool $withSearchUrl
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function getSearch(int $id, $withSearchUrl = false)
    {
        return $this->handleResponse(
            $this->http->get("searches/$id", ['share_url' => (int) $withSearchUrl])
        );
    }

    /**
     * Create a new search by POSTing search terms, parameters and filters
     *
     * @link https://docs.complyadvantage.com/api-docs/#create-searches
     * @param CreateSearchRequest $request
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function createSearch(CreateSearchRequest $request)
    {
        return $this->handleResponse(
            $this->http->post('searches', $request->toArray())
        );
    }

    /**
     * Set monitoring on or off for
     *
     * @param int $searchId
     * @param bool $shouldMonitor
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function setMonitorForSearch(int $searchId, bool $shouldMonitor)
    {
        return $this->handleResponse(
            $this->http->patch("searches/$searchId", ['is_monitored' => $shouldMonitor])
        );
    }

    /**
     * @param Response $response
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function handleResponse(Response $response): array
    {
        if ($response->successful()) {
            return $this->handleSuccess($response);
        } else {
            throw new ComplyAdvantageApiException($response);
        }
    }

    /**
     * @param Response $response
     * @return array
     */
    public function handleSuccess(Response $response): array
    {
        return $response->json();
    }
}
