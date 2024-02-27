<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('migrate:all', function () {
	$databases = config('database')['connections'];

    foreach ($databases as $key => $database) {
        $result = $this->choice('Do you want to migrate on '.$key.'?', ['y', 'n'], 0);
        
        if ($result == 'y') {                
            $this->call('migrate', ['--database' => $key]);                
        } else {
            continue;
        }
    }
})->describe('Run migrate on all databases.');

Artisan::command('migrate:rollbackall', function () {
	$databases = config('database')['connections'];

    foreach ($databases as $key => $database) {
        $result = $this->choice('Do you want to migrate on '.$key.'?', ['y', 'n'], 0);
        
        if ($result == 'y') {                
            $this->call('migrate:rollback', ['--database' => $key]);                
        } else {
            continue;
        }
    }
})->describe('Run migrate:rollback on all databases.');


Artisan::command('db:seedAll', function () {
    $databases = config('database')['connections'];

    foreach ($databases as $key => $database) {
        $result = $this->choice('Do you want to seed on '.$key.'?', ['y', 'n'], 0);

        if ($result == 'y') {
            $this->call('db:seed', ['--database' => $key]);
        } else {
            continue;
        }
    }
})->describe('Run seeder on all databases.');