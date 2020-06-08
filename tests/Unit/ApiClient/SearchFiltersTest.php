<?php


namespace SolStis86\ComplyAdvantage\Tests\Unit\ApiClient;


use Illuminate\Validation\ValidationException;
use SolStis86\ComplyAdvantage\ApiClient\SearchFilters;
use SolStis86\ComplyAdvantage\Tests\TestCase;

class SearchFiltersTest extends TestCase
{
    public function testValidationExceptionIsThrownWhenSettingADisallowedType()
    {
        $filters = SearchFilters::make();

        $this->expectException(ValidationException::class);

        $filters->setTypes(['BAD_TYPE']);
    }

    public function testValidationExceptionIsThrownWhenSettingADisallowedEntity()
    {
        $filters = SearchFilters::make();

        $this->expectException(ValidationException::class);

        $filters->setEntityType('BAD_TYPE');
    }
}
