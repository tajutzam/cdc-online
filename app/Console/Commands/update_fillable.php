<?php

namespace App\Console\Commands;

use App\Models\QuisionerLevel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class update_fillable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-quisioner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $data = QuisionerLevel::select('user_id', DB::raw('MAX(id) as max_id'))
            ->where('expired', '<', Carbon::now())
            ->where('not_fillable_again', false)
            ->groupBy('user_id')
            ->get();

        // Retrieve the full records based on the maximum id for each user
        $records = QuisionerLevel::whereIn('id', $data->pluck('max_id')->toArray())
            ->where('expired', '<', Carbon::now())
            ->get();
        foreach ($records as $key => $value) {
            # code...
            $value->update([
                'not_fillable_again' => true
            ]);
        }
        return 0;
    }
}
