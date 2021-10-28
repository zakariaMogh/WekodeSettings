<?php

namespace Wekode\Settings;

//use App\Providers\SettingServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingSetupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() :void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $timestamp = date('Y_m_d_His', time());
        if (! Schema::hasTable('settings')) {
            $this->publishes([
                __DIR__.'/migrations/create_settings_table.php.stub' => $this->app->databasePath()."/migrations/{$timestamp}_create_settings_table.php",
            ], 'migrations');
        }
        $this->publishes([
            __DIR__.'/Models/Setting.php.stub' => base_path('App/Models/Setting.php'),
            __DIR__.'/seeders/SettingSeeder.php.stub' => base_path('database/seeders/SettingSeeder.php'),
            __DIR__.'/SettingServiceProvider.php.stub' => base_path('App/Providers/SettingServiceProvider.php'),

        ]);

//        $this->app->register(SettingServiceProvider::class);

    }
}
