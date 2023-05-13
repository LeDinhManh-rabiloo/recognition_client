<?php

namespace App\Listeners;

use App\Events\SendMailStockProductNotTransactionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailStockProductNotTransactionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMailStockProductNotTransactionEvent  $event
     * @return void
     */
    public function handle(SendMailStockProductNotTransactionEvent $event)
    {
        $products = $event->listProduct;
        Mail::send('pages.notifications.stockxUpdate', ['products' => $products], function ($message) use ($products) {
            $message->to('manhld@rabiloo.com.vn')
                ->subject("test");
        });
    }
}
