<?php
/**
 * Created by PhpStorm.
 * User: AM-PC
 * Date: 10/3/2017
 * Time: 4:29 PM
 */

namespace App\Http\Controllers;


class PagesController extends Controller
{

    public function getIndex()
    {
        return view('pages.welcome');
    }

    public function getAbout()
    {
        $first = 'Alex';
        $last = 'Curtix';

        $full = $first . " " . $last;
        $email = 'brandnday@gmail.com';

        $statusData = [];
        $statusData['hp'] = 32;
        $statusData['sp'] = 32;
        $statusData['str'] = 32;
        $statusData['int'] = 24;
        $statusData['dex'] = 15;
        $statusData['def'] = 64;


        //return view('pages.about')->with("fullname", $full);
        return view('pages.about')->withFullname($full)->withEmail($email)
            ->with("statusData", $statusData);

    }

    public function getContact()
    {
        return view('pages.contact');
    }


}