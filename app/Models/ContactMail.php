<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;


class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /** 
     * Create a new message instance
     * 
     * @return void
     */

    public function __construct($data)
    {
       $this->data = $data;
    }

    /**
     * Build the message
     * 
     * @return $this
     */

    public function build()
    {
        return $this->subject('Contact us - '.$this->data->subject)->view('contact.send');
    }

}
