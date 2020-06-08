<?php


namespace SolStis86\ComplyAdvantage\Models;


use Illuminate\Database\Eloquent\Model;

class CASearch extends Model
{
    protected $casts = [
        'data' => 'json',
    ];

    protected $fillable = ['data'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('complyadvantage.database.searches_table_name'));
    }

    public function model()
    {
        return $this->morphTo();
    }


}
