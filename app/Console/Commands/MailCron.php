<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\Mail\OnMailSend;
use App\Events\Statistics\OnStatisticsUpdates;
use App\Console\Commands\Domains;

class MailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize uploaded Images for products';

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
       
        event(new OnMailSend());
        event(new OnStatisticsUpdates());
    }
}
