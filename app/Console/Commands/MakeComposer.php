<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class MakeComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:composer {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view composer class';

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
        $file = 'app/Http/ViewComposers/' . $this->argument('name') . '.php';
        if (File::exists($file)) {
            $this->error($this->argument('name') . ' class already exists.');
        } else {
            File::put($file, 
"<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class {$this->argument('name')}
{
    /**
     * Create a new composer view instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  \$view
     * @return void
     */
    public function compose(View \$view)
    {
        // \$view->with('data', \$data);
    }
}
");   
            $this->info($this->argument('name') . ' class created.');
        }
    }
}
