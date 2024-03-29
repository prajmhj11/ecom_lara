<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the Ecommerce Application';

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
        if($this->option('force')){
            $this->proceed();
        }else{
            if($this->confirm('This will delete All your current data and install the default data. Are you sure?')){
                $this->proceed();
            }
        }
    }

    public function proceed()
    {
        $deleteSuccess = File::deleteDirectory(public_path('storge/products/dummy'));
            if($deleteSuccess){
                $this->info('Deleted folder storage/products/dummy');
            }

            $this->callSilent('storage:link');
            $copySuccess = File::copyDirectory(public_path('img/products'), public_path('storage/products/dummy'));
            if($copySuccess){
                $this->info('Images successfully copied to storage folder.');
            }

            $this->call('migrate:fresh', [
                '--seed' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'VoyagerDatabaseSeeder'
            ]);

            $this->call('db:seed', [
                '--class' => 'DataTypesTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'DataRowsTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'MenusTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'MenuItemsTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'RolesTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionsTableSeederCustom'
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionRoleTableSeeder'
            ]);

            $this->call('db:seed', [
                '--class' => 'UsersTableSeeder'
            ]);

            $this->call('db:seed', [
                '--class' => 'UsersTableSeederCustom'
            ]);

            $this->info('Dummy data installed.');
    }
}
