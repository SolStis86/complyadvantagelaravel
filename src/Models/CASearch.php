<?php


namespace SolStis86\ComplyAdvantage\Models;


use Illuminate\Database\Eloquent\Model;
use SolStis86\ComplyAdvantage\ApiClient\ResponseData;

class CASearch extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = ['data'];

    public static function createFromApiResponseData(array $response): self
    {
        $data = data_get($response, 'content.data', []);

        $search = new static(compact('data'));

        $search->save();

        return $search;
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('complyadvantage.database.searches_table_name'));
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function getDataAttribute($value)
    {
        return ResponseData::make(json_decode($value, true));
    }
}
