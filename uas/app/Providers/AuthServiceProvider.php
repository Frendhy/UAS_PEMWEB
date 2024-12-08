<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        App\Models\Book::class => App\Policies\BookPolicy::class,
    ];
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerPolicies();
        //admin buat create
        Gate::define('create-book', function(User $user){
            return $user->role_id === 1;
        });

        Gate::define('update-book', function(User $user, Book $book){
            return $user->id === $book->user_id;
        });
    }
}
