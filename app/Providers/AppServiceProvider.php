<?php

namespace App\Providers;

use App\Models\Average;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\Relation;
use jDateTime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrapThree();
        Relation::morphMap([
            'user' => 'App\Models\User',//using in activitiy log, keep the order with teacher
            
        ]);

        Validator::extendImplicit('matchPassword', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth()->user()->password);
        });
    }

    
}
