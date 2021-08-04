<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Inertia\Inertia;

class CustomerMailVerify extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $code;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $code, $name)
    {
        $this->email = $email;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customerVerify');
       // return $this.code;
       // return Inertia::render('/CustomerVerify/index');
    }
}
