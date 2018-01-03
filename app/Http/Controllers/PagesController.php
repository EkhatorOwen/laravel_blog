<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function getIndex()
    {

        #process data
        #talk to model(update database)
        #receive data from the model
        #compile or process data
        #pass data to the correct view
        return view('pages.welcome');
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
