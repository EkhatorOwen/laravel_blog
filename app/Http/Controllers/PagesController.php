<?php

namespace App\Http\Controllers;

use App\post;

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

    public function postContact()
    {

    }


}
