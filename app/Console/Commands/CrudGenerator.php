<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crud generator';

    public function handle()
    {
        $model = $this->ask('What is the Model name?');
        $this->call('make:model', ['name' => $model, '-m' => true]);
        $this->call('make:custom-controller', ['model' => $model]);
        $this->call('make:service', ['model' => $model]);
        $this->call('make:livewire', ['name' => ucfirst($model) . '/' . ucfirst($model) . 'Table']);
        $this->info('Done bro! 👍');
    }
}
