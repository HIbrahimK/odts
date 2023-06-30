<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('uniqueLevels', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('levels')->where('school_id',Auth::user()->school_id)
                ->where('level', $value)
                ->where('name', $parameters[0])
                ->count();

            return $count === 0;
        });
    }
}
