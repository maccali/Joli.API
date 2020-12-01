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
    $this->subject("Seja Bem Vindo " . $this->pessoa->nome . ' !!!');
    $this->to($this->pessoa->email, $this->pessoa->nome);
    $this->from('sistema@joli.com');
    $this->attach(public_path('/storage/MUAKVKH/dGGUjFeLt3laqJpaD5squDX2ZT2Zh04tQbn1gS3U.jpeg'));
    return $this->markdown('emails.pessoa');
  }
}
