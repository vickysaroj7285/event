<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SendPodcastNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PodcastProcessed $event): void
    {
        $data = $event->data;
        Mail::to($data['email'])->send(new WelcomeEmail([
            'name' => $data['name'],
        ]));
        return;
    }
}
