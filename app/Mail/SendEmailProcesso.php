<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Processo;
use App\Models\User;
use App\Models\Pessoa;

class SendEmailProcesso extends Mailable
{
  use Queueable, SerializesModels;
  public $user;
  public $processo;
  public $pessoa;


  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(User $user, Processo $processo, Pessoa $pessoa)
  {
    $this->user = $user;
    $this->processo = $processo;
    $this->pessoa = $pessoa;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $this->subject("Movimentação Processual: " . $this->processo->cod_processo);
    $this->to($this->user->email, $this->user->name);
    $this->from('sistema@joli.com');
    $this->attach(public_path($this->processo->documento));
    $this->attach(public_path($this->processo->documento_processual));
    return $this->markdown('emails.processo');
  }
}
