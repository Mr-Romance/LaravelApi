<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->default(0)->comment('话题id');
            $table->integer('from_user')->default(0)->comment('评论人用户ID');
            $table->integer('to_user')->default(0)->comment('被评论人用户ID');
            $table->string('content')->default('')->comment('评论内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replay');
    }
}
