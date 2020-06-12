<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


class ResponseData extends DataBag
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->hits = HitData::make($data['hits']);
    }

    public function uri($append = null)
    {
        return "searches/$this->id".($append ? "/$append" : "");
    }
}
