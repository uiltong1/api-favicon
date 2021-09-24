<?php

namespace App\Providers;

use App\Application\Auth\AuthGet;
use App\Application\Auth\AuthLogin;
use App\Application\Maturity\MaturityCreate;
use App\Application\Maturity\MaturityGet;
use App\Application\Maturity\MaturityRemove;
use App\Application\Maturity\MaturityUpdate;
use App\Application\Service\serviceCreate;
use App\Application\Service\ServiceGet;
use App\Application\Service\ServiceRemove;
use App\Application\Service\ServiceUpdate;
use App\Application\User\UserCreate;
use App\Http\Interfaces\Auth\IAuthGet;
use App\Http\Interfaces\Auth\IAuthLogin;
use App\Http\Interfaces\Maturity\IMaturityCreate;
use App\Http\Interfaces\Maturity\IMaturityGet;
use App\Http\Interfaces\Maturity\IMaturityRemove;
use App\Http\Interfaces\Maturity\IMaturityUpdate;
use App\Http\Interfaces\Service\IServiceCreate;
use App\Http\Interfaces\Service\IServiceGet;
use App\Http\Interfaces\Service\IServiceRemove;
use App\Http\Interfaces\Service\IserviceUpdate;
use App\Http\Interfaces\User\IUserCreate;
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
        $this->app->bind(
            IAuthLogin::class,
            AuthLogin::class
        );

        $this->app->bind(
            IAuthGet::class,
            AuthGet::class
        );

        $this->app->bind(
            IUserCreate::class,
            UserCreate::class
        );

        $this->app->bind(
            IServiceCreate::class,
            serviceCreate::class
        );
        $this->app->bind(
            IserviceUpdate::class,
            ServiceUpdate::class
        );

        $this->app->bind(
            IServiceGet::class,
            ServiceGet::class
        );

        $this->app->bind(
            IServiceRemove::class,
            ServiceRemove::class
        );

        $this->app->bind(
            IMaturityCreate::class,
            MaturityCreate::class
        );

        $this->app->bind(
            IMaturityGet::class,
            MaturityGet::class
        );

        $this->app->bind(
            IMaturityUpdate::class,
            MaturityUpdate::class
        );

        $this->app->bind(
            IMaturityRemove::class,
            MaturityRemove::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
