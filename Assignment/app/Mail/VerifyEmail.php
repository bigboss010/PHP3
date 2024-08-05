<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    public function build(){
        return $this->subject('Xác nhận email từ BK Pets')
        ->markdown('login.verifyemail')
        ->with([
            'user' => $this->user,
            'verificationUrl' => $this->verificationUrl 
        ]);
    }
   
}