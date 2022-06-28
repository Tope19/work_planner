<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Packages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Create a new vendour/package and run composer update';

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
