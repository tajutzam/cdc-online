<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use App\Services\QuisionerService;
use Illuminate\Console\Command;

class app_notifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'app_notifications';

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
        $notificationService = new NotificationService();
        $notificationService->findAllUpdateNotification();
        return 0;
    }
}
