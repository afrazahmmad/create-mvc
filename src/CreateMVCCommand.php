<?php

namespace AfrazAhmad\MVC;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateMVCCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mvc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create: Model, Controller, Request and Migrations at once';

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
        $choice = $this->choice('Select one of the given Operations',['1: Create model, controller, migration and request','2: Choose your own.']);
        switch ($choice) {
            case 1:
                $name = $this->ask('Enter name of MVC. It will be used to create model, controller, request and migration.');
                $this->createAll($name);
                break;
            case 2:
                $this->chooseYourOwn();
                break;
            
            default:
                $this->chooseYourOwn();
                break;
        }
    }

    

/*
|--------------------------------------------------------------------------
| Create all at once with single name
|--------------------------------------------------------------------------
|
| Create Model, controller, request and migration with single input
|
*/


    protected function createAll($name) {
        $this->call('make:model', ['name' => "{$name}",'-c' => true,'-m' => true, '-r' => true]);
        $this->makeRequest($name);
    }

    

/*
|--------------------------------------------------------------------------
| Create with user choice
|--------------------------------------------------------------------------
|
| Create or skip creation of Model, controller, request and migration.
|
*/
    protected function chooseYourOwn()
    {
        $this->makeModelWithName();
        $this->makeControllerWithName();
        $this->makeRequestWithName();
        $this->makeMigrationWithName();
    }

    protected function makeModelWithName() {
        $data['makeModel'] = $this->confirm('Do you want to create Model ?',true);
        if($data['makeModel']){
            $data['model'] = $this->ask('Enter Model Name. e.g. folder/model name or just model name');
            if($data['model'])
            {
                $this->makeModel($data['model']); 
            }
        }else{
                $this->error('Ok! No model was created');
            }
    }

    protected function makeControllerWithName() {
        $data['makeController'] = $this->confirm('Do you want to create controller ?',true);
        if($data['makeController']){
            $data['controller'] = $this->ask('Enter controller Name. e.g. folder/controller name or just controller name');
            if($data['controller']) {
                $this->makeController($data['controller']);
            }
        }else{
            $this->error('Ok! No controller was created');
        }
    }
    protected function makeRequestWithName() {
        $data['makeRequest'] = $this->confirm('Do you want to create request ?',true);
        if($data['makeRequest']){
            $data['request'] = $this->ask('Enter request Name. e.g. folder/request name or just request name');
            if($data['request']) {
                $this->makeRequest($data['request']); 
            }
        }else{
            $this->error('Ok! No request was created');
        }
    }
    protected function makeMigrationWithName() {
        $data['makeMigration'] = $this->confirm('Do you want to create migration ?',true);
        if($data['makeMigration']){
            $data['migration'] = $this->ask('Enter migration Name. e.g. folder/migration name or just migration name');
            if($data['migration']) {
                $this->makeMigration($data['migration']); 
            }
        }else{
            $this->error('Ok! No migration was created');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Make MVC functions
    |--------------------------------------------------------------------------
    |
    | Create Model, controller, request and migration.
    |
    */


    protected function makeModel($model) {
        $this->call('make:model', ['name' => "{$model}"]);
    }

    protected function makeController($controller) {
        $controller = Str::studly(class_basename($controller));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', [
            'name' => "{$controller}Controller",
            '--model' => $this->option('resource') ? $modelName : null,
        ]);
        
    }

    protected function makeRequest($request) {
        $this->call('make:request', ['name' => "{$request}Request"]); 
    }

    protected function makeMigration($migration) {
        $table = Str::plural(Str::snake(class_basename($migration)));
        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

}
