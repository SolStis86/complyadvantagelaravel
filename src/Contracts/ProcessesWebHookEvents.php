<?php


namespace SolStis86\ComplyAdvantage\Contracts;


interface ProcessesWebHookEvents
{
    public function processPayload(array $payload);
}
