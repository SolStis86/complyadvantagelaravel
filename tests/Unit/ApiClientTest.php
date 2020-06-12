<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit;


use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient;
use SolStis86\ComplyAdvantage\ApiClient\SearchFilters;
use SolStis86\ComplyAdvantage\ApiClient\CreateSearchRequest;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class ApiClientTest extends TestCase
{
    public $runMigrations = true;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(function (Request $request) {
            switch ($request->method()) {
                case 'POST':
                    return Http::response($this->getStubAsArray('example-response'), 200, []);
                case 'GET':
                    return Http::response($this->getStubAsArray('get-searches'), 200, []);
                default:
                    return Http::response([], 404);
            }
        });
    }

    public function testItCallsTheApiWithCorrectAuthorizationHeader()
    {
        config(['complyadvantage.api_key' => 'AkEyExampLE']);

        $api = new ApiClient();

        $searchRequest = new CreateSearchRequest('TEST TERM');

        $api->createSearch($searchRequest);

        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Token AkEyExampLE');
        });
    }

    public function testCreateSearchRequestParamsAreInRequestBody()
    {
        $api = new ApiClient();

        $searchRequest = CreateSearchRequest::make('TEST TERM')
            ->setParams([
                'client_ref' => 'client ref',
                'fuzziness' => 0.2,
                'filters' => SearchFilters::make()
                    ->setTypes([SearchFilters::TYPE_ADVERSE_MEDIA_GENERAL])
            ]);

        $api->createSearch($searchRequest);

        Http::assertSent(function ($request) {
            return $request['client_ref'] === 'client ref'
                && $request['fuzziness'] === 0.2
                && $request['filters'] === [
                    'types' => [SearchFilters::TYPE_ADVERSE_MEDIA_GENERAL],
                ];
        });
    }
}
