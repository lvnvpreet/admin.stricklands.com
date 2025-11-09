<?php

namespace Vanguard\Providers;

use Carbon\Carbon;
use Vanguard\Models\Delivery;
use Vanguard\Models\Locations;
use Vanguard\Repositories\Activity\ActivityRepository;
use Vanguard\Repositories\Activity\EloquentActivity;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Country\EloquentCountry;
use Vanguard\Repositories\Permission\EloquentPermission;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\EloquentRole;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\Session\DbSession;
use Vanguard\Repositories\Session\SessionRepository;
use Vanguard\Repositories\User\EloquentUser;
use Vanguard\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Gate;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(app()->environment() == 'production'){
            URL::forceScheme('https');
        }

        Carbon::setLocale(config('app.locale'));
        config(['app.name' => settings('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);

        Gate::define('only-admin', function ($user) {
            return ($user->hasRole('Admin') || $user->hasRole('superadmin'));
        });

        View::composer('partials.sidebar',function($view){
            $userdetail = auth()->user()->details;
            if($userdetail->fld_usr_cat == 3){
                $location = Locations::where('fldLocation',100)->first();

                $query = Delivery::where(function($query) use ($userdetail){
                    $query->where('fld_sperson',$userdetail->id)
                        ->orWhere('fld_sperson2',$userdetail->id);
                })->where('s_spare','No')
                    ->where('fld_date','>=',$location->day_start)
                    ->where('fld_funded','Yes');

                $newSaleSolo = (clone $query)->whereNull('fld_sperson2')
                                            ->where('fld_tracker_type',0)
                                            ->where('fld_new_used','1')
                                            ->count();

                $newSaleSplit = (clone $query)->where('fld_tracker_type',0)
                                                ->whereNotNull('fld_sperson2')
                                                ->where('fld_new_used','1')
                                                ->count();

                $newTotal = $newSaleSolo + ($newSaleSplit/2);
                $newPercent = ($userdetail->fld_new_target == 0) ? 100 : ($newTotal/$userdetail->fld_new_target) * 100;
               // dd($newTotal);

                $usedSoloSales = (clone $query)->whereNull('fld_sperson2')
                    ->where('fld_tracker_type',1)
                    ->where('fld_new_used','2')
                    ->count();

                $usedSplitSales = (clone $query)->where('fld_tracker_type',1)
                    ->whereNotNull('fld_sperson2')
                    ->where('fld_new_used','2')
                    ->count();

                $usedTotal = $usedSoloSales + ($usedSplitSales/2);
                $usedPercent = ($userdetail->fld_usr_target == 0) ? $newPercent : ($usedTotal/$userdetail->fld_usr_target) * 100;

                $totalPercent = ($newPercent + $usedPercent)/2;

                $view->with('slaes_percent',$totalPercent);
            }

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
