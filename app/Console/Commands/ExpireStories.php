<?php

namespace App\Console\Commands;

use App\Story;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExpireStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cdc:expire-stories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It expires stories by resting one day in its "days_to_expire". If a story reaches zero "days_to_expire" -> the task gets deleted.';

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
     * @return mixed
     */
    public function handle()
    {
        $stories = Story::all();

        $stories->each(function (Story $story) {

            if (--$story->days_to_expire > 0)
                $story->save();
            else {
                Log::debug('Expiring Story:', ['object' => $story->toJson()]);
                $story->delete();
            }
        });
    }
}
