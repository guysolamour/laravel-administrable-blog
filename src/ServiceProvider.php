<?php

namespace Guysolamour\Administrable\Extensions\Blog;

use Illuminate\Support\Str;
use Illuminate\Console\Scheduling\Schedule;
use Guysolamour\Administrable\Extensions\Blog\Jobs\PublishProgrammaticalyPost;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const PACKAGE_NAME = 'administrable-blog';

    public function boot()
    {
        $this->publishes([
            static::packagePath("config/" . self::PACKAGE_NAME . ".php") => config_path(self::PACKAGE_NAME . '.php'),
        ], self::PACKAGE_NAME . '-config');

        $this->publishes([
            static::packagePath('resources/lang') => resource_path('lang/vendor/' . static::PACKAGE_NAME),
        ], static::PACKAGE_NAME . '-lang');

        $this->loadRoutesFrom(static::packagePath("/routes/back.php"));
        $this->loadRoutesFrom(static::packagePath("/routes/front.php"));

        $this->loadTranslationsFrom(static::packagePath('resources/lang'), static::PACKAGE_NAME);

        $this->loadMigrationsFrom([
            config(self::PACKAGE_NAME . '.migrations_path'),
        ]);

        $this->loadViewsFrom(static::packagePath('/resources/views/front'), self::PACKAGE_NAME);
        $this->loadViewsFrom(static::packagePath('/resources/views/back/' . Str::lower(config('administrable.theme'))), self::PACKAGE_NAME);

        $this->scheduleCommands();
    }

    private function scheduleCommands(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->job(new PublishProgrammaticalyPost)->daily();
        });
    }


    public function register()
    {
        $this->mergeConfigFrom(
            static::packagePath('config/' . self::PACKAGE_NAME . '.php'),
            self::PACKAGE_NAME
        );
    }

    public static function packagePath(string $path = ''): string
    {
        return  __DIR__ . '/../' . $path;
    }
}

