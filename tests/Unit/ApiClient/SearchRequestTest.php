<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit\ApiClient;


use RuntimeException;
use SolStis86\ComplyAdvantage\ApiClient\SearchRequest;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class SearchRequestTest extends TestCase
{
    public function testSearchTermIsSetOnInitialisation()
    {
        $request = SearchRequest::make('TEST TERM');

        $this->assertTrue($request->search_term === 'TEST TERM');
    }

    public function testAllowedParametersCanBeSet()
    {
        $allowedParams = [
            'search_term' => 'TEST TERM',
            'client_ref' => 'client ref',
            'search_profile' => 'profile',
            'offset' => 0,
            'limit' => 10,
            'fuzziness' => 0.1,
            'tags' => 'test',
            'share_url' => 1,
            'exact_match' => 0,
            'country_codes' => ['s'],
        ];

        $request = SearchRequest::make('TEST TERM');

        foreach ($allowedParams as $key => $val) {
            $request->{$key} = $val;
            $this->assertTrue($request->{$key} === $val);
        }
    }

    public function testDirectlySettingAnIncorrectParamThrowsRuntimeException()
    {
        $incorrectParamName = 'incorrect_param';

        $this->expectException(RuntimeException::class);

        $this->expectExceptionMessage("Create search parameter $incorrectParamName not allowed.");

        $request = SearchRequest::make('test search term');

        $request->$incorrectParamName = 'value';
    }

    public function testThatSetParamsAreInArray()
    {
        $params = [
            'search_profile' => 'profile',
            'offset' => 0,
            'limit' => 10,
        ];

        $request = SearchRequest::make('TEST TERM')
            ->setParams($params);

        $this->assertIsArray($request->toArray());
        $this->assertArrayHasKey('search_profile', $request->toArray());
    }

    public function testThatSettingAnIncorrectParamThrowsRuntimeException()
    {
        $params = [
            'search_profile' => 'profile',
            'offset' => 0,
            'limit' => 10,
            'INCORRECT_PARAM' => 0,
        ];

        $this->expectException(RuntimeException::class);

        SearchRequest::make('TEST TERM')
            ->setParams($params);
    }
}
