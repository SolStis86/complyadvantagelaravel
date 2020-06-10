<?php


namespace SolStis86\ComplyAdvantage\ApiClient;


class ResponseData extends DataBag
{
    public function uri($append = null)
    {
        return "searches/$this->id".($append ? "/$append" : "");
    }
}
