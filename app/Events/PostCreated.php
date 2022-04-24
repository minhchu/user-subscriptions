<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated
{
    use Dispatchable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Post
     */
    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware()
    {
        return [(new WithoutOverlapping($this->post->id))->dontRelease()->expireAfter(180)];
    }
}
