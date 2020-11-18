<?php

namespace App\Mail;

use App\Certificacion\Idioma;
use App\TipoDocumento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoTurnoCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Turno creado correctamente";
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.turnoCreado');
    }
}
