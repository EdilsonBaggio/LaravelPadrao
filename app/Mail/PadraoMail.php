<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PadraoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome; public $email; public $assunto; public $mensagem;

    public function __construct($nome, $email, $assunto, $mesangem)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->assunto = $assunto;
        $this->mensagem = $mesangem;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->assunto,
            replyTo: [
                new Address($this->email, $this->nome),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.contato',
            with: [
                'nome' => $this->nome,
                'assunto' => $this->assunto,
                'mensagem' => $this->mensagem,
                'email' => $this->email
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}