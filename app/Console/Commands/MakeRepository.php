<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

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
        if (File::exists('app/Repositories/' . $this->argument('name') . '.php')) {
            $this->error($this->argument('name') . ' class already exists.');
        } else {
            File::put('app/Repositories/' . $this->argument('name') . '.php',
"<?php

namespace App\Repositories;

class {$this->argument('name')}
{

}
");
            $this->info($this->argument('name') . ' class created.');
        }
    }
}
