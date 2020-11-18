<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificacionExitosa extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Certificación Exitosa";
    public $from = [['address' => 'sitio@esti.cu', 'name' => 'Sitio Web']];
    public $sms;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($entity)
    {
        $this->sms = $entity;
        $nombre = 'Equipo de Servicios de Traductores e Intérpretes';
        $this->from = [['address' => 'sitio@esti.cu', 'name' => $nombre]];
        $this->subject = "Solicitud de certificación";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.certificicacionExitosa');
    }
}
