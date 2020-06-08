<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit;


use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient;
use SolStis86\ComplyAdvantage\ApiClient\SearchFilters;
use SolStis86\ComplyAdvantage\ApiClient\SearchRequest;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class ApiClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake();
    }

    public function testItCallsTheApiWithCorrectAuthorizationHeader()
    {
        config(['complyadvantage.api_key' => 'AkEyExampLE']);

        $api = new ApiClient();

        $searchRequest = new SearchRequest('TEST TERM');

        $api->createSearch($searchRequest);

        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Token AkEyExampLE');
        });
    }

    public function testSearchRequestParamsAreInRequestBody()
    {
        $api = new ApiClient();

        $searchRequest = SearchRequest::make('TEST TERM')
            ->setParams([
                'client_ref' => 'client ref',
                'fuzziness' => 0.2,
                'filters' => SearchFilters::make()
                    ->setTypes([SearchFilters::TYPE_ADVERSE_MEDIA_GENERAL])
            ]);

        $api->createSearch($searchRequest);

        Http::assertSent(function ($request) {
            print_r($request);
            return $request['client_ref'] === 'client ref'
                && $request['fuzziness'] === 0.2
                && $request['filters'] === [];
        });
    }
}
