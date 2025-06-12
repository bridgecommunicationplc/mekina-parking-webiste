<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inqSubject;
    public $inqMessage;
    public $fromEmail;
    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $message
     * @return void
     */
    public function __construct($subject, $message,$recipients)
    {
        $this->inqSubject = $subject;
        $this->inqMessage = $message;
        $this->fromEmail = $recipients;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject($this->inqSubject)->view('send_email')->with('data', $this->inqMessage);
    }
}


?>