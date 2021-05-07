<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class Demo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(Session::get('demo_v') == false){
            return $next($request); 
        }




        $routes_not_allow_for_demo  = [

            'admin.order.add',
            'admin.order.store',
            'admin.order.update',
            'admin.order.delete',
            'admin.order.confirm',
            'admin.customer.delete',


            'admin.product.store',
            'admin.product.update',
            'admin.product.delete',
            'admin.product.active_deactivated',
            'admin.product.home_show_hide',


            'admin.category.store',
            'admin.category.update',
            'admin.category.delete', 
            'admin.category.show_home',
            'admin.category.left_nav',

          
            'admin.email.delete', 
            'admin.email.send', 


            'admin.coupon.store',
            'admin.coupon.update',
            'admin.coupon.delete',
            'admin.coupon.active',


            'admin.review.active',
            'admin.review.delete',

            'admin.slider.store',
            'admin.slider.active',
            'admin.slider.delete',

            'admin.faq.store',
            'admin.faq.update',
            'admin.faq.delete',

            'admin.popup.store',
            'admin.popup.update',
            'admin.faq.delete',


            'admin.about.update',
            'admin.contact.update',
            'admin.privacy.update',
            'admin.condition.update',
            
            'admin.profile.update',
            'admin.profile.password_change',
           


            'admin.settings.update',
            'admin.settings.seo.update',
            'admin.settings.social_media.update',
            'admin.ecommerce.update',


        ];

        
        $this_request = $request->route()->getName();

        if(in_array($this_request, $routes_not_allow_for_demo)){
            
            if($request->ajax()){
                    return response()->json([
                        'message' => "!!!!! You are in demo version !!!!!"
                    ]);
            }else{
                return back()->with('success',"!!!!! You are in demo version !!!!!");
            }

        }else{

            return $next($request); 
        }










    }
}
