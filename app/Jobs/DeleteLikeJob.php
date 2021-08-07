<?php

namespace App\Jobs;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteLikeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function handle()
    {
        $existing_like = Like::wherePostId($this->data['post_id'])->whereUserId($this->data['user_id'])->first();

        if ($existing_like){
            $existing_like->delete();
        }
    }
}
