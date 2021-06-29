<?php

namespace App\Listeners;

use App\Events\ModelUnRated;
use App\Models\Product;
use App\Notifications\ModelUnRatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailModelUnRatedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(ModelUnRated $event)
    {
        $rateable = $event->getRateable();

        if($rateable instanceof Product){
            $notification = new ModelUnRatedNotification(
                $event->getQualifier()->name,
                $event->getRateable()->name
            );
            $rateable->createdBy->notify($notification);
        }
    }
}
