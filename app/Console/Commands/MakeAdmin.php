<?php

namespace App\Console\Commands;
use Webpatser\Uuid\Uuid;
use App\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make super admin user';

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
        $email = $this->ask('Enter email address: ');
        if (User::whereEmail($email)->exists()) {
            $this->error("User with this email address already exists");
        } else {
            $password = $this->secret('Enter password: ');
            $this->info("Creating new admin...");
            User::create([
                    'uuid' => Uuid::generate(1)->string,
                    'role' => 'web',
                    'email' => $email,
                    'password' => bcrypt($password),
                    'phone' => '00000000',
                ]);
            $this->info("New admin created.");
        }
    }
}
