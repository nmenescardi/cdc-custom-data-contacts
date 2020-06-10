<?php

namespace App\Providers;

use App\Tag;
use Illuminate\Support\Facades\Schema;
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
        $this->app->singleton(
            'App\Feedback\FeedbackInterface',
            'App\Feedback\Feedback',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer(['components.existing-tags-field'], function ($view) {
            $view->with(
                'allTags',
                Tag::pluck('name', 'id')->toArray()
            );
        });
    }
}
