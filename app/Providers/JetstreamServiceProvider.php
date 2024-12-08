<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        // Kullanıcı silme işlemi için Jetstream yapılandırması
        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Vite'yi yapılandırma (JavaScript ve CSS için önbellek)
        Vite::prefetch(concurrency: 3);

        // Middleware alias kaydını burada yapıyoruz
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        // API token izinleri
        Jetstream::defaultApiTokenPermissions(['read']);

        // Jetstream izinleri
        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
