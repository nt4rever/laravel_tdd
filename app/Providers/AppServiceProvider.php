<?php

namespace App\Providers;

use App\Domains\ImageManageContract;
use App\Services\ImageServices\ImgbbImageService;
use App\Services\ImageServices\SelfHostedImageService;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\DatabaseCheck;

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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // registering the contract
        $this->app->bind(ImageManageContract::class, function ($app, $parameters) {
            if (isset($parameters['service'])) {
                $imageServices = new Collection([
                    SelfHostedImageService::NAME => SelfHostedImageService::class,
                    ImgbbImageService::NAME => ImgbbImageService::class,
                ]);

                return app($imageServices[$parameters['service']]);
            }
        });

        Health::checks([
            DatabaseCheck::new(),
        ]);
    }
}
