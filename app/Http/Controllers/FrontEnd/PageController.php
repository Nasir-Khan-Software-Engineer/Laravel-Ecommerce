<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\About;
use App\Condition;
use App\Privacy;
use App\Contact;
use App\Faq;
use App\Email;

use App\Mail\PhoneNotification;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about_page(Request $request){

        // dd($request->path());


        $about =  Cache::rememberForever('about-page',function() {
            return About::find(1);
        });
        // dd($about);
        return view('public.pages.about',compact('about'));
    }


    public function condition_page(){

        $condition =  Cache::rememberForever('condition-page',function() {
            return Condition::find(1);
        });

    	return view('public.pages.condition',compact('condition'));
    }


    public function privacy_page(){

        $privacy =  Cache::rememberForever('privacy-page',function() {
            return Privacy::find(1);
        });

    	return view('public.pages.privacy',compact('privacy'));
    }   


    public function contact_page(){
    	return view('public.pages.contact');
    }

    public function help_page(){
        $faqs =  Cache::rememberForever('all-faq',function() {
                   return Faq::all();
               });
        return view('public.pages.help',compact('faqs'));
    }

    public function faq_page(){

        $faqs =  Cache::rememberForever('all-faq',function() {
            return Faq::all();
        });

        // dd($faqs);


        return view('public.pages.faq',compact('faqs'));
    }




    public function email_send(Request $r){



        $e = new Email;
        $e->name = $r->name;
        $e->email = $r->email;
        $e->phone = $r->phone;
        $e->subject = $r->subject;
        $e->message = $r->message;
        $e->save();



        $data =  array(

            'name'      => $e->name,
            'email'     => $e->email,
            'phone'     => $e->phone,
            'subject'   => $e->subject,
            'message'   => $e->message
        );
        
        // Mail::to("contact@gmail.com")->send(new PhoneNotification($data));
        
       //Mail::to("nasirkhan.webdev@gmail.com")->send(new ContactUs($data));


        return response()->json([
            'message' => 'Success'
        ]);
    }


   
}
