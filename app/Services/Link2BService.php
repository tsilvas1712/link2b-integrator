<?php

  namespace App\Services;

  use App\Jobs\WhatsSend;
  use Illuminate\Bus\Queueable;
  use Illuminate\Contracts\Queue\ShouldQueue;

  class Link2BService implements ShouldQueue
  {
    use Queueable;

    public function sendWhats(object $sale, object $campaings)
    {
      if ($sale->status === 'PORTABILIDADE') {
        $sale->update(['status' => 'AGENDADO']);
        WhatsSend::dispatch($sale, $campaings)->delay(now()->addDays(4));
      } else {
        WhatsSend::dispatch($sale, $campaings);
      }
    }
  }
