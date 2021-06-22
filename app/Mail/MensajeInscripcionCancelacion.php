<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeInscripcionCancelacion extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "[Información] Solicitud de certificación";
    public $from = [['address' => 'sitio@esti.cu', 'name' => 'Sitio Web']];
    public $sms;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitud)
    {
        $this->sms = [$solicitud];
        
        $this->from = [['address' => 'sitio@esti.cu', 'name' => 'Sitio Web']];
        // $this->subject = $mensaje['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mensajeInscripcionCancelada');
    }
}
