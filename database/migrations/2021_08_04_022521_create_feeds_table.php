<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * Отслеживающиеся статьи
 */
class CreateFeedsTable extends Migration
{
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');

            $table->index(['user_id', 'post_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
