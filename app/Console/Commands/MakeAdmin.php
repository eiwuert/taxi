<?php

namespace App\Console\Commands;

use DB;
use App\Web;
use App\User;
use Webpatser\Uuid\Uuid;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email} {password}';

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
        $email = $this->argument('email');
        if (User::whereEmail($email)->exists()) {
            $this->error("User with this email address already exists");
        } else {
            $password = $this->argument('password');
            $userId = 
                DB::table('users')->insert([
                    'uuid' => Uuid::generate(1)->string,
                    'role' => 'web',
                    'email' => $email,
                    'password' => bcrypt($password),
                    'phone' => '00000000',
                    'verified' => true
                ]);
            User::whereEmail($email)->firstOrFail()->web()
                                    ->create([
                                        'first_name' => 'Beautiful',
                                        'last_name'  => 'Admin',
                                    ]);
            $this->info("New admin created.");
        }
    }
}
