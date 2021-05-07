<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Review;
use App\Email;
class NotificationController extends Controller
{
   public function order(){
   	$orders = Order::where('seen','=',0)->orderBy('created_at','DESC')->get();

   	$total_notification = $orders->count();

   	return response()->json([
   		'orders' => $orders,
   		'total_notification' => $total_notification
   	]);
   }




   public function review(){
   	$reviews = Review::where('seen','=',0)->orderBy('created_at','DESC')->get();

   	$total_notification = $reviews->count();

   	return response()->json([
   		'reviews' => $reviews,
   		'total_notification' => $total_notification
   	]);
   }

   public function email(){
       $emails = Email::where('seen','=',0)->orderBy('created_at','DESC')->get();

       $total_notification = $emails->count();

       return response()->json([
           'emails' => $emails,
           'total_notification' => $total_notification
       ]);
   }
}
