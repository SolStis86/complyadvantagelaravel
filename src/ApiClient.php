<?php


namespace SolStis86\ComplyAdvantage;


use Closure;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient\ResponseData;
use SolStis86\ComplyAdvantage\ApiClient\SearchRequest;
use SolStis86\ComplyAdvantage\Exceptions\ComplyAdvantageApiException;

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
        return $this->handleResponse(
            $this->http->post('searches', $request->toArray())
        );
    }

    /**
     * @param ResponseData $data
     * @param $shouldMonitor
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function setMonitorForSearch(ResponseData $data, $shouldMonitor)
    {
        return $this->handleResponse(
            $this->http->patch($data->uri('monitors'), ['is_monitored' => $shouldMonitor])
        );
    }

    /**
     * @param Response $response
     * @return array
     * @throws ComplyAdvantageApiException
     */
    public function handleResponse(Response $response)
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
    public function handleSuccess(Response $response)
    {
        return $response->json();
    }
}
