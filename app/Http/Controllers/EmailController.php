<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\User;

use App\Mail\AdminSend;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
	public function index(){
		$emails  = Email::orderBy('created_at','DESC')->get();

		return view('admin.email.index',compact('emails'));
	}


	public function send(Request $r){


		$email 		= $r->email;
		$subject 	= $r->subject;
		$message 	= $r->message;

		$data =  array(
		    // 'subject'    => $subject,
		    // 'name'       => $name,
		    // 'email'      => $email,
		    // 'message'    => $message
		);
		
		Mail::to("contact@gmail.com")->send(new AdminSend($data));


		return response()->json([
			'success' => 'Success',
			'data'    => $r->email
		]);
	}

	public function delete(Request $r){
		$email = Email::find($r->id);
		$email->delete();

	
		return response()->json([
			'message' => 'Success'
		]);
	}



	public function seen(Request $r){
		$email = Email::find($r->id);

		$email->seen = 1;

		$email->save();
		return response()->json([
			'message' => 'Success'
		]);
	}


	public function show($id){
		$email = Email::find($id);
		
		return view('admin.email.show',compact('email'));
	}

	public function download(){
	    $emails = Email::orderBy('id','DESC')->get();

	    $email_data =  array();

	    foreach ($emails as  $e) {
	        
	        $this_email = [

	            'name'  		=>$e->name,
	            'email'  		=>$e->email,
	            'subject'  		=>$e->subject,
	            'Date'  		=>$e->created_at->format('d-m-Y'),
	        ];
	        $email_data[] = $this_email;
	    }

	    $filename = 'Data_Email_'.date("l_d_m_Y").'.csv';       
	    header("Content-type: text/csv");       
	    header("Content-Disposition: attachment; filename=$filename");       
	    $output = fopen("php://output", "w");

	    $header = ['Name','Email','Subject','Date'];
	    fputcsv($output, $header);
	    $header = ['','','',''];
	    fputcsv($output, $header);  

	    foreach($email_data as $e)       
	    {  
	        fputcsv($output, $e);  
	    }       
	    fclose($output); 
	}


}
