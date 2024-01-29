<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class CreateCustomControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:custom-controller {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom controller command';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath(): string
    {
        return base_path('stubs/custom-controller.stub');
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables(): array
    {
        return [
            'CLASS_NAME' => $this->getSingularClassName($this->argument('model')),
            'MODEL_NAME' => ucfirst($this->argument('model')),
            'LOWER_DIR_NAME' => strtolower(Pluralizer::plural($this->argument('model')))
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return array|false|string|string[]
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return array|false|string|string[]
     */
    public function getStubContents($stub, array $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath(): string
    {
        return base_path('App/Http/Controllers/' . $this->getSingularClassName($this->argument('model')) . 'Controller.php');
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    protected function makeDirectory(string $path): string
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        $dir = "resources/views/admin/" . strtolower(Pluralizer::plural($this->argument('model')));
        $stub = 'stubs/custom-views';
        //vars
        $title = Pluralizer::plural($this->argument('model'));
        $icon = 'fas fa-circle';
        $route = 'admin.' . strtolower(Pluralizer::plural($this->argument('model')));

        //index view
        $this->call('make:file', [
            'name' => $dir . "/index.blade.php",
            'stub' => $stub . '/index.stub',
            '--vars' => [
                'title' => $title,
                'icon' => $icon,
                'route' => $route
            ]
        ]);

        //show view
        $this->call('make:file', [
            'name' => $dir . "/show.blade.php",
            'stub' => $stub . '/show.stub',
            '--vars' => [
                'title' => $title,
                'icon' => $icon,
                'route' => $route
            ]
        ]);

        //create view
        $this->call('make:file', [
            'name' => $dir . "/create.blade.php",
            'stub' => $stub . '/create.stub',
            '--vars' => [
                'title' => $title,
                'icon' => $icon,
                'route' => $route
            ]
        ]);

        //edit view
        $this->call('make:file', [
            'name' => $dir . "/edit.blade.php",
            'stub' => $stub . '/edit.stub',
            '--vars' => [
                'title' => $title,
                'icon' => $icon,
                'route' => $route
            ]
        ]);

        //form view
        $this->call('make:file', [
            'name' => $dir . "/form.blade.php",
            'stub' => $stub . '/form.stub',
            '--vars' => [
                'title' => $title,
                'icon' => $icon,
                'route' => $route
            ]
        ]);

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("Created : " . $path);
        } else {
            $this->error("File : {$path} already exits");
        }

    }
}
