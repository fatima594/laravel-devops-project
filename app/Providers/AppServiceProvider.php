<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Image\ImageService;
use Intervention\Image\Facades\Image;
use App\Models\SocialMedia;





class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register()
    {
        // ربط ImageService في الحاوية
        $this->app->bind(Image::class, function ($app) {
            return new Image();
        });
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // جلب كل وسائل التواصل الاجتماعي
        $socialMedias = SocialMedia::all();

        // مشاركة المتغير مع كل الـ views
        view()->share('socialMedias', $socialMedias);
    }
}
