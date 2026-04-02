<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SmmBlueprintForm;

class PaymentFailedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;

    public function __construct(SmmBlueprintForm $form)
    {
        $this->form = $form;
    }

    public function build()
    {
        return $this->subject('Payment Failed – Social Media Management Blueprint')
                    ->markdown('emails.payment.failed');
    }
}