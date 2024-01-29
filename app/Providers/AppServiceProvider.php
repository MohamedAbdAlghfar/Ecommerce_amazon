<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
                                                                            
class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    
    public function boot()
    {
        try {
            DB::connection()->getPdo();
            Schema::disableForeignKeyConstraints();
            Schema::defaultStringLength(191);
            DB::statement('SET SESSION sql_require_primary_key=0');

            } catch (\Exception $e) {
            // die("Could not connect to the database.  Please check your configuration. error:" . $e );
            }
    }
}
