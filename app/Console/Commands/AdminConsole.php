<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin Console for installing MyBackend';

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
         $this->line('Tunggu');
        
        $this->output->progressStart(10);

        for ($i = 1; $i <= 3; $i++) {
            sleep(1);
            $this->output->progressAdvance();
            
            if($i==3)
            {
                \Artisan::call('migrate');
                \Artisan::call('db:seed');
                \Artisan::call('key:generate');
            }
        }
        \Artisan::call('vendor:publish');
        $this->output->progressFinish();
        $this->line('Update Telah Berhasil :)');
        $this->line('By : Muhamad Reza');
    }
}
