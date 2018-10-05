<?php

namespace App\Providers;

use App\Billing\Stripe;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Http\Resources\Json\Resource; // da ne bi vracao u data object object izabranog posta vec samo taj post (value) (api) (postman)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view){

            $archives = \App\Post::archives();
            $tags = \App\Tag::has('posts')->pluck('name');
            $view->with(compact('archives', 'tags'));

        });
        // Resource::withoutWrapping(); // da ne bi vracao u data object object izabranog posta vec samo taj post (value) (api) (postman)
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Stripe::class, function() {
            return new Stripe(config('services.stripe.secret'));
        });
    }
}