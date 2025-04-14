<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Đăng ký Policy nếu có
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Định nghĩa Gate 'admin'
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
