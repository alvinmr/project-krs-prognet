<?php

namespace App\Providers;

use App\Models\Mahasiswa;
use App\Models\Pegawai;
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
        view()->composer('layouts.app', function ($view) {
            $view->with('pegawai', Pegawai::all());
            $view->with('mahasiswa', Mahasiswa::all());
        });
    }
}