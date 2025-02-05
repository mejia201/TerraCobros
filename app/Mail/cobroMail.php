<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class cobroMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdfPath;


    /**
     * Create a new message instance.
     */
    public function __construct($pdfPath, $data)
    {
        //

        $this->pdfPath = $pdfPath;
        $this->data = $data;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificacion de pago',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     view: 'emails.factura',
        // );

        // return new Content(
        //     view: 'emails.factura',
        //     with: ['cliente' => $this->data['cliente']]
        // );

        return new Content(
            view: 'emails.factura',
            with: ['cliente' => $this->data['cliente'] ?? null]
        );
        

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // return [];
        // return [
        //     new \Illuminate\Mail\Mailables\Attachment($this->pdfPath),
        // ];

        if (!Storage::exists($this->pdfPath)) {
            return [];
        }
    
        return [
            Attachment::fromPath(storage_path("app/{$this->pdfPath}"))
        ];
    }
}
