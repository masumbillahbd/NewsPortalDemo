<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class newsPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** publish_time
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('News publish started');
        $posts = Post::whereRaw("DATE_FORMAT(publish_time, '%Y-%m-%d %H:%i') = ?", [Carbon::now()->format('Y-m-d H:i')])->get();
        foreach ($posts as $post) {
            $post->update(['post_status' => 3]);
            $this->info("News publish completed");
        }
    }
}
