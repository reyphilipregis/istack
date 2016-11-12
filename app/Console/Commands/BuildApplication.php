<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BuildApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the application';

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
        $this->info('Building the application...');
        $this->info(shell_exec('composer install'));
        $this->info(shell_exec('php artisan clear-compiled'));
        $this->info(shell_exec('php artisan config:clear'));
        $this->info(shell_exec('php artisan cache:clear'));
        $this->info(shell_exec('php artisan migrate:refresh --seed'));
        $this->info(shell_exec('phpunit'));
        $this->info('Finished building the application...');
        $this->info(shell_exec('php artisan serve'));
    }
}