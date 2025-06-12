<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;

class SendEmailController extends Controller
{
    public function __construct()
    {
    }


    function sendMail(Request $request)
    {

        $data = $request->all();

        $subject = $data['subject'];
        $message = $data['message'];
        $recipients = $data['recipients'];

        Mail::to($recipients)->send(new SendMail($subject, $message,$recipients));

        return "email sent successfully!";
    }
}

?>