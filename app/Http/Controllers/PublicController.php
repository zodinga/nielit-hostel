<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Session;

class PublicController extends Controller
{
    public function getIndex(){
       return view('public.index');
    }
    
    public function getAbout(){
        return view('public.about');
    }


    public function getContact(){
        return view('public.contact');
    }

    public function postContact(Request $request){
        //dd($request);
        $this->validate($request,[
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
            ]);
//dd($request);
        $data=[
        'email'=>$request->email,
        'subject'=>$request->subject,
        'bodyMessage'=>$request->message
        ];
        Mail::send('emails.contact',$data,function($message) use ($data) {
            $message->from($data['email']);
            $message->to('nielitaizawlserver@gmail.com');
            $message->subject($data['subject']);

        });
        Session::flash('success','Your opinion/suggestion has been received by us!! Thank you..');
        return redirect()->route('index');
    }

    public function getMail($type,$course_id){
        //dd($type.' '.$course_id);
        $year=Paper::pluck('year','id');
        return view('public.mail',['type'=>$type,'course_id'=>$course_id,'year'=>$year]);
    }



}
