<?php

namespace Daavelar\Laravel\Console;

use File;
use Illuminate\Console\Command;

class MakeView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a view file';

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
        $partsOfView = explode('.', $this->argument('view'));
        $nameOfFile = array_pop($partsOfView);

        $paths = implode('/', $partsOfView);

        if (!is_dir(view_path($paths))) {
            mkdir(view_path($paths), 0777, true);
        }

        $viewName = $paths . '/' . $nameOfFile . '.blade.php';

        if (file_exists(view_path($viewName))) {
            throw new \Exception("File already exists.");
        }

        File::put(view_path($viewName), '');

        $this->info('File created.');
    }

}
