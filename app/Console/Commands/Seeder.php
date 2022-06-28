<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeder:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command generate seeder for database 
                                if no tables, run migration and generate seeder 
                                else just generate seeder';

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
        //
    }
}
