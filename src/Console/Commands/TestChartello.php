<?php

namespace Chartello\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;

class TestChartello extends Command
{
    protected $signature = 'chartello:test';

    protected $description = 'Set up a new Laravel project and test a fresh installation of Chartello (for internal use)';

    public function handle()
    {
        $this->createLaravelProject();
        $this->generateApplicationKey();
        $this->configureChartelloRepository();
        $this->installChartello();
        $this->changeDatabaseToSqlite();
        $this->runMigrations();
        $this->publishTests();
        $this->runTests();
    }

    protected function createLaravelProject()
    {
        exec('composer create-project laravel/laravel laravel');
    }

    protected function generateApplicationKey()
    {
        $key = 'base64:'.base64_encode(
            Encrypter::generateKey($this->laravel['config']['app.cipher'])
        );

        $this->updateEnvVariable('APP_KEY=', "APP_KEY=$key");
    }

    protected function configureChartelloRepository()
    {
        $repository = '{"type": "path", "url": "../", "options": {"symlink": true}}';

        exec("composer config repositories.chartello '$repository' -d laravel");
    }

    protected function installChartello()
    {
        exec('composer require chartello/chartello:@dev -d laravel');

        exec('php ./laravel/artisan chartello:install');
    }

    protected function changeDatabaseToSqlite()
    {
        $databasePath = getcwd().'/laravel/database/database.sqlite';
        $this->updateEnvVariable('DB_CONNECTION=mysql', 'DB_CONNECTION=sqlite');

        exec("touch $databasePath");

        exec("awk '{sub(/DB_DATABASE=laravel/,\"DB_DATABASE=$databasePath\")}1' ./laravel/.env > ./laravel/temp.env && mv ./laravel/temp.env ./laravel/.env");
    }

    protected function runMigrations()
    {
        exec('php ./laravel/artisan migrate --force', $output);
    }

    protected function updateEnvVariable($from, $to)
    {
        exec("cd laravel && awk '{sub(/$from/,\"$to\")}1' .env > temp.env && mv temp.env .env");
    }

    protected function publishTests()
    {
        exec('php ./laravel/artisan vendor:publish --tag=chartello-tests');
    }

    protected function runTests()
    {
        exec('cd laravel && php artisan test', $output);

        $this->getOutput()->write(implode("\n", $output));
    }
}
