<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['settings'])->group(function () {
  
// index page
Route::get('/','FrontEnd\PublicController@index')->name('website.home');

// category
Route::get('/categories','FrontEnd\CategoryController@categories')->name('website.all_categories');
Route::get('/category/{slug}','FrontEnd\CategoryController@single_category')->name('website.single_category');

// ecommerce
Route::get('/shop','FrontEnd\EcommerceController@shop')->name('website.shop_page');
Route::post('/shop-filter','FrontEnd\EcommerceController@shop_filter')->name('website.shop_filter');

Route::get('/offer/{slug}','FrontEnd\EcommerceController@offer')->name('website.offer_page');


Route::get('/check-out', 'FrontEnd\EcommerceController@check_out')->name('website.check_out');

// page
Route::get('/about', 'FrontEnd\PageController@about_page')->name('website.about_page');
Route::get('/condition', 'FrontEnd\PageController@condition_page')->name('website.condition_page');
Route::get('/privacy-policy', 'FrontEnd\PageController@privacy_page')->name('website.privacy_page');
Route::get('/faq', 'FrontEnd\PageController@faq_page')->name('website.faq_page');
Route::get('/help', 'FrontEnd\PageController@help_page')->name('website.help_page');

// email
Route::get('/contact', 'FrontEnd\PageController@contact_page')->name('website.contact_page');
Route::post('/contact/email/send', 'FrontEnd\PageController@email_send')->name('website.email.send');



// search
Route::post('/search', 'FrontEnd\ProductController@search')->name('website.search');



// cart page
Route::get('/cart', 'FrontEnd\CartController@view_cart')->name('website.cart.view');
Route::get('/check-out', 'FrontEnd\CartController@check_out')->name('website.cart.check_out');



//customer auth
Route::get('/customer/registration', 'FrontEnd\AuthController@registration')->name('website.customer.registration')->middleware('guest');
Route::get('/customer/login', 'FrontEnd\AuthController@login')->name('website.customer.login')->middleware('guest');


Route::post('/order-submit', 'FrontEnd\OrderController@submit')->name('website.order.submit');
Route::get('/confirm', 'FrontEnd\OrderController@confirm')->name('website.order.confirm');




}); // end settings middleware


Route::post('/add-to-cart', 'FrontEnd\CartController@add_to_cart')->name('website.cart.add');
Route::post('/delete-full-cart', 'FrontEnd\CartController@delete_full_cart')->name('website.cart.delete.full');

Route::post('/create-cart', 'FrontEnd\CartController@create_cart')->name('website.cart.create');

Route::post('/delete-cart-product', 'FrontEnd\CartController@delete_cart_product')->name('website.cart.delete.product');
Route::post('/update-cart', 'FrontEnd\CartController@update_cart')->name('website.cart.update');

Route::post('/coupon-apply', 'FrontEnd\CartController@apply_coupon')->name('website.cart.apply_coupon');
Route::post('/coupon-delete', 'FrontEnd\CartController@delete_coupon')->name('website.cart.delete_coupon');











// review 
Route::middleware(['auth'])->group(function () {

  Route::post('/review-submit', 'FrontEnd\ReviewController@store')->name('website.review.store');

});













Auth::routes();



Route::group([
	'prefix' => 'admin',
	'middleware' => [
		'auth','admin','permission','demo'
	],
], function (){

   Route::get('/', 'HomeController@index')->name('admin.home');
   Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');

   // orders 
   Route::get('/orders','OrderController@index')->name('admin.orders');
   Route::get('/order/add','OrderController@add')->name('admin.order.add');
   Route::get('/order/show/{id}','OrderController@show')->name('admin.order.show');
   Route::get('/order/invoice/{id}','OrderController@invoice')->name('admin.order.invoice');
   Route::get('/order/edit/{id}','OrderController@edit')->name('admin.order.edit');
   Route::post('/order/store','OrderController@store')->name('admin.order.store');
   Route::post('/order/update','OrderController@update')->name('admin.order.update');

   Route::post('/order/update/product','OrderController@accept_product')->name('admin.order.accept_product');

   Route::post('/order/delete','OrderController@delete')->name('admin.order.delete');
   Route::post('/order/confirm','OrderController@confirm')->name('admin.order.confirm');
   Route::post('/order/download','OrderController@download')->name('admin.order.download');

   Route::post('/order/auto_seen','OrderController@seen')->name('admin.order.seen');



   // customers 
   Route::get('/customers','CustomerController@index')->name('admin.customers');
   Route::get('/customer/show/{id}','CustomerController@show')->name('admin.customer.show');
   Route::post('/customer/delete','CustomerController@delete')->name('admin.customer.delete');
   Route::post('/customer/block','CustomerController@block')->name('admin.customer.block');
   Route::post('/customer/download','CustomerController@download')->name('admin.customer.download');



   // products 
   Route::get('/products','ProductController@index')->name('admin.products');
   Route::get('/product/add','ProductController@add')->name('admin.product.add');
   Route::get('/product/show/{slug}','ProductController@show')->name('admin.product.show');
   Route::get('/product/edit/{id}','ProductController@edit')->name('admin.product.edit');
   Route::post('/product/store','ProductController@store')->name('admin.product.store');
   Route::post('/product/update','ProductController@update')->name('admin.product.update');
   Route::post('/product/delete','ProductController@delete')->name('admin.product.delete');
   Route::post('/product/active_deactivated','ProductController@active_deactivated')->name('admin.product.active_deactivated');
   Route::post('/product/home_show_hide','ProductController@home_show_hide')->name('admin.product.home_show_hide');
   Route::post('/product/download','ProductController@download')->name('admin.product.download');

   // categories
   Route::get('/categories','CategoryController@index')->name('admin.categories');
   Route::get('/category/show/{slug}','CategoryController@show')->name('admin.category.show');
   Route::post('/category/store','CategoryController@store')->name('admin.category.store');
   Route::post('/category/update','CategoryController@update')->name('admin.category.update');
   Route::post('/category/delete','CategoryController@delete')->name('admin.category.delete');
   Route::post('/category/show_home','CategoryController@show_home')->name('admin.category.show_home');
   Route::post('/category/left-nav','CategoryController@left_nav')->name('admin.category.left_nav');
   Route::post('/category/download','CategoryController@download')->name('admin.category.download');


   Route::get('/offers','OfferController@index')->name('admin.offers');
   Route::get('/offer/show/{slug}','OfferController@show')->name('admin.offer.show');
   Route::get('/offer/edit/{slug}','OfferController@edit')->name('admin.offer.edit');
   Route::get('/offer/add','OfferController@add')->name('admin.offer.add');
   Route::post('/offer/store','OfferController@store')->name('admin.offer.store');
   Route::post('/offer/update','OfferController@update')->name('admin.offer.update');
   Route::post('/offer/delete','OfferController@delete')->name('admin.offer.delete');
   Route::post('/offer/active','OfferController@active')->name('admin.offer.active');




   Route::get('/emails','EmailController@index')->name('admin.emails');
   Route::get('/email/show/{id}','EmailController@show')->name('admin.email.show');
   Route::post('/email/delete','EmailController@delete')->name('admin.email.delete');
   Route::post('/email/download','EmailController@download')->name('admin.email.download');
   Route::post('/email/send','EmailController@send')->name('admin.email.send');





   // coupons
   Route::get('/coupons','CouponController@index')->name('admin.coupons');
   Route::get('/coupon/add','CouponController@add')->name('admin.coupon.add');
   Route::get('/coupon/edit/{id}','CouponController@edit')->name('admin.coupon.edit');
   Route::get('/coupon/show/{id}','CouponController@show')->name('admin.coupon.show');
   Route::post('/coupon/store','CouponController@store')->name('admin.coupon.store');
   Route::post('/coupon/update','CouponController@update')->name('admin.coupon.update');
   Route::post('/coupon/delete','CouponController@delete')->name('admin.coupon.delete');
   Route::post('/coupon/active','CouponController@active')->name('admin.coupon.active');


   // packages
   Route::get('/packages','PackageController@index')->name('admin.packages');
   Route::get('/package/add','PackageController@add')->name('admin.package.add');
   Route::get('/package/show/{id}','PackageController@show')->name('admin.package.show');
   Route::get('/package/edit/{id}','PackageController@edit')->name('admin.package.edit');
   Route::post('/package/store','PackageController@store')->name('admin.package.store');
   Route::post('/package/update','PackageController@update')->name('admin.package.update');
   Route::post('/package/delete','PackageController@delete')->name('admin.package.delete');

   // reviews
   Route::get('/reviews','ReviewController@index')->name('admin.reviews');
   Route::get('/review/add','ReviewController@add')->name('admin.review.add');
   Route::get('/review/show/{id}','ReviewController@show')->name('admin.review.show');
   Route::get('/review/edit/{id}','ReviewController@edit')->name('admin.review.edit');
   Route::post('/review/store','ReviewController@store')->name('admin.review.store');
   Route::post('/review/update','ReviewController@update')->name('admin.review.update');
   Route::post('/review/delete','ReviewController@delete')->name('admin.review.delete');
   Route::post('/review/active','ReviewController@active')->name('admin.review.active');
   
   Route::post('/review/auto_seen','ReviewController@seen')->name('admin.review.seen');


   //seo
   Route::get('/seo','SeoController@index')->name('admin.seos');
   Route::post('/seo/home-page','SeoController@home_page')->name('admin.seo.home-page');
   Route::post('/seo/about-page','SeoController@about_page')->name('admin.seo.about-page');
   Route::post('/seo/contact-page','SeoController@contact_page')->name('admin.seo.contact-page');



   // users
   Route::get('/users','CustomUserController@index')->name('admin.users');
   Route::get('/user/add','CustomUserController@add')->name('admin.user.add');
   Route::get('/user/show/{id}','CustomUserController@show')->name('admin.user.show');
   Route::get('/user/edit/{id}','CustomUserController@edit')->name('admin.user.edit');
   Route::post('/user/store','CustomUserController@store')->name('admin.user.store');
   Route::post('/user/update','CustomUserController@update')->name('admin.user.update');
   Route::post('/user/delete','CustomUserController@delete')->name('admin.user.delete');
   Route::post('/user/active','CustomUserController@active')->name('admin.user.active');

   // settings
    Route::get('/settings','SettingsController@index')->name('admin.settings');
    Route::get('/settings/documentaion','SettingsController@documentaion')->name('admin.settings.documentaion');
    Route::post('/settings','SettingsController@update')->name('admin.settings.update');
    Route::post('/settings/seo','SettingsController@seo_update')->name('admin.settings.seo.update');
    Route::post('/settings/social','SettingsController@social_media_update')->name('admin.settings.social_media.update');

    Route::post('/settings/notification/email','SettingsController@notification_email')->name('admin.settings.notification.email');


    // Route::get('/ecommerce','EcommerceController@index')->name('admin.ecommerce');
    Route::get('/about','AboutController@edit')->name('admin.about');
    Route::get('/contact','ContactController@edit')->name('admin.contact');
    Route::get('/privacy','PrivacyController@edit')->name('admin.privacy');
    Route::get('/condition','ConditionController@edit')->name('admin.condition');

    Route::post('/ecommerce','EcommerceController@update')->name('admin.ecommerce.update');
    Route::post('/ecommerce/payment','EcommerceController@payment_settings')->name('admin.settings.ecommerce.payment');


    Route::post('/about','AboutController@update')->name('admin.about.update');
    Route::post('/contact','ContactController@update')->name('admin.contact.update');
    Route::post('/privacy','PrivacyController@update')->name('admin.privacy.update');
    Route::post('/condition','ConditionController@update')->name('admin.condition.update');


    // profile 
    Route::get('/profile', 'SettingsController@profile')->name('admin.profile');
    Route::post('/profile', 'SettingsController@user_profile_update')->name('admin.profile.update');
    Route::post('/profile/password', 'SettingsController@password_change')->name('admin.profile.password_change');





    // report
    Route::get('/report/order','ReportController@order_index')->name('admin.reports.orders');
    Route::post('/reports/order/download','ReportController@orders_download')->name('admin.orders.reports.download');


    Route::get('/report/product','ReportController@product_index')->name('admin.reports.product');
    Route::get('/reports/product/download','ReportController@products_download')->name('admin.product.reports.download');


    Route::get('/report/category','ReportController@category_index')->name('admin.reports.category');
   Route::post('/reports/category/download','ReportController@category_download')->name('admin.category.reports.download');

    Route::get('/report/customer','ReportController@customer_index')->name('admin.reports.customer');
    Route::post('/reports/customer/download','ReportController@customer_download')->name('admin.customer.reports.download');;
   




    // slider
    Route::get('/sliders','SliderController@index')->name('admin.sliders');
    Route::get('/slider/add','SliderController@add')->name('admin.slider.add');
    Route::get('/slider/edit/{id}','SliderController@edit')->name('admin.slider.edit');
    Route::get('/slider/show/{id}','SliderController@show')->name('admin.slider.show');
    Route::post('/slider/store','SliderController@store')->name('admin.slider.store');
    Route::post('/slider/active','SliderController@active')->name('admin.slider.active');
    Route::post('/slider/delete','SliderController@delete')->name('admin.slider.delete');


    // faq
    Route::get('/faqs','FaqController@index')->name('admin.faqs');
    Route::get('/faq/add','FaqController@add')->name('admin.faq.add');
    Route::get('/faq/edit/{id}','FaqController@edit')->name('admin.faq.edit');
    Route::get('/faq/show/{id}','FaqController@show')->name('admin.faq.show');
    Route::post('/faq/store','FaqController@store')->name('admin.faq.store');
    Route::post('/faq/update','FaqController@update')->name('admin.faq.update');
    Route::post('/faq/delete','FaqController@delete')->name('admin.faq.delete');


    // popup
    Route::get('/popups','PopupController@index')->name('admin.popups');
    Route::post('/popup/store','PopupController@store')->name('admin.popup.store');
    Route::post('/popup/active','PopupController@active')->name('admin.popup.active');
    Route::post('/popup/delete','PopupController@delete')->name('admin.popup.delete');

    

    // notification
    Route::post('/order_notification','NotificationController@order')->name('admin.notification.order');
    Route::post('/review_notification','NotificationController@review')->name('admin.notification.review');
    Route::post('/email_notification','NotificationController@email')->name('admin.notification.email');

     
    
});



// cache gorute

Route::post('/clear-cache', 'CacheControl@clear_cache')->name('admin.cache.clear');





Route::group([
   'prefix' => 'customer',
   'middleware' => [
      'auth','customer',
   ],
], function (){

   Route::get('/', 'Customer\DashboardController@index')->name('customer.home');
   Route::get('/order', 'Customer\DashboardController@order')->name('customer.order');

   Route::get('/order/{id}', 'Customer\DashboardController@single')->name('customer.order.single');
   Route::post('/order/{id}/cancel', 'Customer\DashboardController@cancel')->name('customer.order.cancel');

   Route::get('/profile', 'Customer\DashboardController@profile')->name('customer.profile');
   Route::get('/profile/edit', 'Customer\DashboardController@profile_edit')->name('customer.profile.edit');
   Route::post('/profile', 'Customer\DashboardController@user_profile_update')->name('customer.profile.update');

   Route::get('/profile/edit/passowrd', 'Customer\DashboardController@change_password_page')->name('customer.profile.edit.password');

   Route::post('/profile/passowrd', 'Customer\DashboardController@password_change')->name('customer.profile.password_change');

   Route::get('/reviews', 'Customer\DashboardController@reviews')->name('customer.reviews');
  
});






// single product
Route::middleware(['settings'])->group(function () {
  Route::get('/{slug}', 'FrontEnd\ProductController@single_product')->name('website.single_product');
});

