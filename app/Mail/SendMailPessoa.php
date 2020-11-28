<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pessoa;

class SendMailPessoa extends Mailable
{
  use Queueable, SerializesModels;
  public $pessoa;


  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Pessoa $pessoa)
  {
    $this->pessoa = $pessoa;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->from('to@email.com')
      ->view('emails.test');
  }
}
