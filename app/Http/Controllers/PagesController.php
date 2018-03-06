<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use App\post;
use illuminate\Http\Request;
use Mail;

class PagesController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('created_at','desc')->limit(4)->get();

        #process data
        #talk to model(update database)
        #receive data from the model
        #compile or process data
        #pass data to the correct view
        return view('pages.welcome')->with('posts',$posts);
    }

    public function getAbout()
    {
        $first = 'Owen';
        $last = 'Ekhator';
        $email = 'owenekhator@rocketmail.com';
        $full = $first." ".$last;
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $full;
        return view('pages.about')->withData($data);

      //  return view('pages.about')->withfullname($full)->withemail($email);
        // return view('pages.about')->with("fullname",$full);

    }

    public function getContact()
    {
        return view('pages/contact');
    }

    public function postContact(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'subject'=>'min:3',
            'message'=>'min:10'
        ]);
            $data = array(
               'email'=>$request->email,
                'subject'=>$request->subject,
                'bodyMessage'=>$request->message
            );

        Mail::send('emails.contact',$data,function($message) use ($data){

            $message->from($data['email']);
            $message->to('owenekhator@rocketmail.com');
            $message->subject($data['subject']);

        });

           session()->flash('success','Your mail was successfully sent');
            return redirect('/');
    }
}
