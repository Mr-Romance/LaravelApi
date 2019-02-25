<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('reply_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('last_reply_user_id')->default(0);
            $table->integer('order')->default(0);
            $table->text('excerpt')->nullable(); // 摘要，SEO优化时使用
            $table->string('slug')->nullable(); // SEO友好的URI
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
        Schema::dropIfExists('topics');
    }
}
