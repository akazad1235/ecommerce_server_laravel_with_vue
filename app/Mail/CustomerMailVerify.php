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
    public function __construct($email, $code, $fName)
    {
        $this->email = $email;
        $this->code = $code;
        $this->name = $fName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customerVerify')->with('code', $this->code)->with('name', $this->name);
    }
}
