<?php


namespace SolStis86\ComplyAdvantage;


use SolStis86\ComplyAdvantage\Contracts\ProcessesWebHookEvents;
use SolStis86\ComplyAdvantage\WebHookEventProcessors\MatchStatusUpdatedProcessor;

class WebHookEventProcessor
{
    private $payload;

    /**
     * @var ProcessesWebHookEvents[]
     */
    protected $eventMap = [
        'match_status_updated' => MatchStatusUpdatedProcessor::class,
    ];

    public function process(array $payload)
    {
        (new static())->eventMap[$payload['event']]->processPayload($payload);
    }
}
