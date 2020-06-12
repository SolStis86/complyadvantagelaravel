<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit\Models;


use Illuminate\Support\Facades\Http;
use SolStis86\ComplyAdvantage\ApiClient;
use SolStis86\ComplyAdvantage\ApiClient\SearchFilters;
use SolStis86\ComplyAdvantage\ApiClient\CreateSearchRequest;
use SolStis86\ComplyAdvantage\Models\CASearch;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class CASearchModelTest extends TestCase
{
    public $runMigrations = true;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(function ($request) {
            $dummyResponse = json_decode(file_get_contents(__DIR__.'/../../stubs/example-response.json'), true);

            return Http::response(
                $dummyResponse,
                200,
                []
            );
        });
    }

    public function testResponseIsSavedToModel()
    {
        $api = new ApiClient();

        $searchRequest = CreateSearchRequest::make('TEST TERM')
            ->setParams([
                'client_ref' => 'client ref',
                'fuzziness' => 0.2,
                'filters' => SearchFilters::make()
                    ->setTypes([SearchFilters::TYPE_ADVERSE_MEDIA_GENERAL])
            ]);

        $response = $api->createSearch($searchRequest);

        $this->assertArrayHasKey('content', $response);
        $this->assertArrayHasKey('data', $response['content']);

        $model = CASearch::createFromApiResponseData($response);

        $this->assertInstanceOf(ApiClient\ResponseData::class, $model->data);

        $this->assertDatabaseHas(
            config('complyadvantage.database.searches_table_name'),
            ['data' => $model->data->__toString()]
        );
    }
}
