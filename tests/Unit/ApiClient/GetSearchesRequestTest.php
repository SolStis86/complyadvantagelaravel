<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit\ApiClient;


use SolStis86\ComplyAdvantage\ApiClient\Requests\GetSearchesRequest;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class GetSearchesRequestTest extends TestCase
{
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

        $request = GetSearchesRequest::make()
            ->setParams($allowedParams);

        foreach ($allowedParams as $key => $val) {
            $request->{$key} = $val;
            $this->assertTrue($request->{$key} === $val);
        }
    }
}
