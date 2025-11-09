<?php

namespace Vanguard\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Vanguard\Models\Locations;
use Vanguard\Models\SupportTicket;
use Vanguard\User;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Vanguard\Model' => 'Vanguard\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\Auth::user()->hasRole({$expression})) : ?>";
        });

        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; ?>";
        });

        \Blade::directive('permission', function ($expression) {
            return "<?php if (\\Auth::user()->hasPermission({$expression})) : ?>";
        });
        
        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; ?>";
        });

        Gate::define('permission',function(User $user,$permission){
            return \Auth::user()->hasPermission($permission);
        });

        Gate::define('sales-tracking',function(User $user, $location_id){//dump($location_id);
            if($user->hasRole('superadmin') || $user->hasRole('Admin')) return true;
            if(!$user->hasPermission('sales-tracking')) return false;
            if(empty($user->details)) return false;
            return  $user->details->fld_usr_location == $location_id;
        });

        Gate::define('manage-session', function (User $user, $session) {
            if ($user->hasPermission('users.manage')) {
                return true;
            }
            return (int) $user->id === (int) $session->user_id;
        });

        Gate::define('has-role',function(User $user,$role){
            if(strpos($role,'|') !== -1){
                $roles = explode('|',$role);
                foreach ($roles as $role){
                    if($user->hasRole($role)) return true;
                }
                return false;
            }else{
                return $user->hasRole($role);
            }
        });

        Gate::define('access-ticket',function(User $user, SupportTicket $ticket){
            return ($user->hasRole('superadmin') || $user->id == $ticket->assigned_to || $user->id == $ticket->user->id);
        });
    }
}
