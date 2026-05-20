<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // View Composer: Tự động nhét biến $danh_sach_phong vào TẤT CẢ các file view nằm trong thư mục nhansu/day4/
        View::composer('nhansu.*', function ($view) {
            $view->with('danh_sach_phong', ['Phong IT', 'Phong Hanh chinh', 'Phong Ke toan']);
        });
    }
}
