<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Chức năng show view chỉ định role
        // Ví dụ Danh danh User chỉ Admin được phép show View còn quyền khắc k hiện ra view
        // nhược điểm: biết URL có thể truy cập
        Blade::if('hasrole', function ($expression) {
            if (Auth::user()) {
                //Phân quyền nhìu role có thể truy cập
                // Mún 1 role truy cập thì ->hasRole() xem chi tiết Model Users

                if (Auth::user()->hasAnyRoles($expression)) {
                    return true;
                }
            }
            return false;
        });
    }
}
