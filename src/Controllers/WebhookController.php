<?php


namespace SolStis86\ComplyAdvantage\Controllers;


use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use SolStis86\ComplyAdvantage\WebHookEventProcessor;

class WebhookController extends Controller
{
    /**
     * @param WebHookEventProcessor $eventProcessor
     * @param Request $request
     * @return Application|ResponseFactory|Response|object
     */
    public function __invoke(WebHookEventProcessor $eventProcessor, Request $request)
    {
        try {
            $eventProcessor->process($request->toArray());
            return response();
        } catch (Exception $exception) {
            return response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
