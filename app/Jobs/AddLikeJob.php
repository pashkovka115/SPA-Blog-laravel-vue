<?php

namespace App\Jobs;

use App\Models\Like;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class AddLikeJob implements ShouldQueue
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

        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $this->data['post_id'],
                'user_id' => $this->data['user_id']
            ]);
        }
    }
}
