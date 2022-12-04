<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccessReport extends Mailable
{
    use Queueable, SerializesModels;
public $demail;
public $time;
public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demail,$time,$file)
{
    $this->demail= $demail;
    $this->time= $time;
    $this->file= $file;

        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.AccessReport') ->subject('Access Alert: Cloud Data Security System (Encrypto)');
    }
}
