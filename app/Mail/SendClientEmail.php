<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClientEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $el;
    public function __construct($el)
    {
        $this->el=$el;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ghiurcaalin@gmail.com')->view('admin.mails.mail')
            ->text('admin.mails.mail_text')->with([
                'infoname'=>'MadreamsRent'
            ]);
    }
}
