<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Lomba;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Gate::define('active-competition', function (User $user, Lomba $lomba) {
            return $lomba->tanggal_mulai <= today() && $lomba->tanggal_selesai >= today();
        });
    }
}
