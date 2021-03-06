<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\NewPost;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscribers implements ShouldQueue
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
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        if ($post->is_email_sent) {
            return;
        }

        $website = $post->website;

        $website->subscribers()->chunk(100, function ($users) use ($post) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new NewPost($post));
            }
        });

        $post->is_email_sent = true;

        $post->save();
    }
}
