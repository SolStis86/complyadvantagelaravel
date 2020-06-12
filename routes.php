<?php

use Illuminate\Routing\Route;

Route::post(config('complyadvantage.webhooks.uri'), config('complyadvantage.webhooks.controller'));
