<?php

namespace App\Console\Commands;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Console\Command;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:new_post {id : The ID of the post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to subscribers about new post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $post = Post::find($this->argument('id'));

        if (!$post) {
            $this->warn('Post not found');

            return 1;
        }

        if ($post->is_email_sent) {
            $this->warn('Email is already sent');

            return 1;
        }

        PostCreated::dispatch($post);

        $this->info('Sending emails ...');

        return 0;
    }
}
