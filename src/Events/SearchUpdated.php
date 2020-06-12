<?php


namespace SolStis86\ComplyAdvantage\Events;


class SearchUpdated
{
    /**
     * @var array
     */
    public $payload;

    /**
     * SearchUpdated constructor.
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
