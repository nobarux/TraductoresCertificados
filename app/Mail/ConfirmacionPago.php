<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionPago extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $from = [['address' => 'sitio@esti.cu', 'name' => 'Sitio Web']];
    public $sms;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje, $destinatario)
    {
        $this->subject = "Pago confirmado";
        $this->sms = $mensaje;
        $nombre = 'En nombre de ['.$mensaje['name'].']';
        $this->from = [['address' => 'sitio@esti.cu', 'name' => $nombre]];
        $this->subject = $mensaje['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mensajeRecibido');
    }
}
