<?php

namespace App\Jobs;

use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DuiLieDemo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static $topic_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 示例：这里处理 topics的 slug字段
        /**
         * @var app/Models/Topic $topic_id
         */
        $topic_model=Topic::find(self::$topic_id);
        $topic_model->slug='test-add-sulg-by-duilie';
        $topic_model->save();
    }

    public static function setter($topic_id){
        self::$topic_id = $topic_id;
    }
}
