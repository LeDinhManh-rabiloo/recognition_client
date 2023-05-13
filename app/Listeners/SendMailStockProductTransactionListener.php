<?php

namespace App\Listeners;

use App\Events\SendMailStockProductTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;

class SendMailStockProductTransactionListener
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
     * @param  SendMailStockProductTransaction  $event
     * @return void
     */
    public function handle(SendMailStockProductTransaction $event)
    {
        $products = $event->listProduct;
        Mail::send('pages.notifications.stockxUpdate', ['products' => $products], function ($message) use ($products) {
            $message->to('manhld@rabiloo.com.vn')
                ->subject("test");
        });
    }
}
