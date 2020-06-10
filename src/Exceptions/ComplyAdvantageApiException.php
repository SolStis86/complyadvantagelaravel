<?php


namespace SolStis86\ComplyAdvantage\Exceptions;


use Exception;
use Illuminate\Http\Client\Response;
use Throwable;

/**
 * Exception ComplyAdvantageApiException
 */
class ComplyAdvantageApiException extends Exception
{
    /**
     * @var Response
     */
    public $response;

    public function __construct(Response $response, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }
}
