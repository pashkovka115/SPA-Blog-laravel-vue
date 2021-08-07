<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserTable extends Migration
{
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->index(['post_id', 'user_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('post_user');
    }
}
