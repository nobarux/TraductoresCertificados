<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Error extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Error en el sitio";
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
        $nombre = 'En nombre del Equipo de Servicios de Traductores e Intérpretes';
        $this->from = [['address' => 'sitio@esti.cu', 'name' => $nombre]];
        $this->subject = "Errores en el sitio";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.error');
    }
}