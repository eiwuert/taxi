<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class AppInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize app for the first time.';

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
        if (env('APP_ENV', 'production') == 'production') {
            $this->comment('*******************************************************');
            $this->comment('**************** App in production !! *****************');
            $this->comment('*******************************************************');
            $this->comment('');
            if (!$this->confirm('Do you wish to continue?')) {
                return;
            }
        }
        $bar = $this->output->createProgressBar(5);
        $this->info("Building " . config('app.name'));
        Artisan::call('migrate:refresh', ['--force' => true]);
        $bar->advance();
        $this->info(" Creating tables");
        Artisan::call('db:seed', ['--class' => 'CarTypeTableSeeder',
                                  '--force' => true]);
        $bar->advance();
        $this->info(" Seed car types");
        Artisan::call('db:seed', ['--class' => 'StatusTableSeeder',
                                  '--force' => true]);
        $bar->advance();
        $this->info(" Seed trip status");
        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder',
                                  '--force' => true]);
        $bar->advance();
        $this->info(" Seed fake clients and drivers");
        Artisan::call('make:admin', ['email'    => 'admin@mysite.com', 
                                     'password' =>'123456']);
        $bar->finish();
        $this->info(" Create default admin");
        $header = ['Email', 'Password'];
        $admin = [['admin@mysite.com', '123456']];
        $this->table($header, $admin);
        $this->question("       Start Redis on your server. (You must do it)           ");
        $this->question("      Start MongoDB on your server. (You must do it)          ");
        $this->question("    Start node.js driver no response app. (You must do it)    ");
    }
}
