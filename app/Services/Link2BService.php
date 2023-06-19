<?php

namespace App\Services;

use App\Jobs\WhatsSend;
use App\Models\Sale;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class Link2BService implements ShouldQueue
{
    use Queueable;

    public function sendWhats(object $sale,object $campaings)
    {
        WhatsSend::dispatch($sale,$campaings);
    }
}