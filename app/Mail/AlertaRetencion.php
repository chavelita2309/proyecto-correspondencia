<?php

namespace App\Mail;

use App\Models\Correspondencia; // Importa el modelo Correspondencia
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Opcional, si quieres que se ponga en cola
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertaRetencion extends Mailable // Nombre de la clase cambiado a AlertaRetencion
{
    use Queueable, SerializesModels;

    public $correspondencia; // Propiedad para el objeto Correspondencia
    public $mensajeAlerta;   // Propiedad para el mensaje de alerta

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(Correspondencia $correspondencia, string $mensajeAlerta)
    {
        $this->correspondencia = $correspondencia;
        $this->mensajeAlerta = $mensajeAlerta;
    }

    /**
     * Obtiene el sobre del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alerta de Trámite Pendiente - ' . $this->correspondencia->codigo_seguimiento, // Asunto dinámico
        );
    }

    /**
     * Obtiene la definición del contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.alerta_retencion', //  vista para enviar correo
        );
    }

    /**
     * Obtiene los adjuntos para el mensaje.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
