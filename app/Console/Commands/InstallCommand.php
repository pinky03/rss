<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install\reset application';

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
        $this->call('migrate:fresh');
        $this->call('key:generate');

        $this->call('orchid:admin', [
            'name' => 'admin',
            'email' => env('APP_ADMIN_MAIL', 'admin@admin.com'),
            'password' => env('APP_ADMIN_PASSWORD', 'admin'),
        ]);

        return 0;
    }
}
