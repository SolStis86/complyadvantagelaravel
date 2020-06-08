<?php


namespace SolStis86\ComplyAdvantage\Traits;

use Illuminate\Database\Eloquent\Model;
use SolStis86\ComplyAdvantage\Models\CASearch;

/**
 * Trait HasCASearches
 * @mixin Model
 */
trait HasCASearches
{
    public function caSearches()
    {
        $this->morphMany(CASearch::class, 'model');
    }
}
