<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Settings;
use App\Category;
use App\Ecommerce;
use App\Offer;
use App\Slider;
use App\Popup;
use App\User;
use Session;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Cache::rememberForever('site-settings', function () {
            return Settings::find(1);
        });

        $categories = Cache::rememberForever('all-categories', function () {
            return Category::with('products')->orderBy('id','ASC')->get();
        });

        $ecommerce = Cache::rememberForever('ecommerce-settings', function () {
            return Ecommerce::find(1);
        });

       $offers = Cache::rememberForever('all-offers',function() {
        return Offer::with('products')->orderBy('id','DESC')->get();
       });  

       $sliders =  Cache::rememberForever('sliders', function () {
        return Slider::with('user')->get();
       });

       $popup =  Cache::rememberForever('popup-active', function () {
        return Popup::with('user')->where('active','=',1)->first();
       });

       $permissions_array = '';

       if(Session::has('user_id')){
        $user_id    = Session::get('user_id');
        $user       = User::find($user_id);

        
       }

       // dd(Auth::user());

       view()->composer('*', function($view){
              if (Auth::check()){

                 $permission_str = Auth::user()->permissions;
                 $permissions_array =  explode(",",$permission_str);

                 $view->with('user_permissions', $permissions_array);

              }else {
                $permissions_array = '';
                 $view->with('user_permissions', $permissions_array);
              }

          });

        View::share([
            'settings'      => $settings,
            'categories'    => $categories,
            'ecommerce'     => $ecommerce,
            'offers'        => $offers,
            'sliders'       => $sliders,
            'popup'         => $popup
            

        ]);

        Schema::defaultStringLength(191);
    }
}
