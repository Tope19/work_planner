<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Mail\OnNewsletterEvent;
use App\Events\Statistics\OnStatisticsUpdates;
use App\Console\Commands\Domains;

class NewsletterCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user update newsletter';

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
       
        event(new OnNewsletterEvent());
    }
}
