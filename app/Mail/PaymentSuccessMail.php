<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SmmBlueprintForm;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $plainPassword;

    public function __construct(SmmBlueprintForm $form,$plainPassword)
    {        
        $this->form = $form;
        $this->plainPassword = $plainPassword;
    }

    public function build()
    {
        return $this->subject('Payment Successful – Social Media Management Blueprint')
                    ->markdown('emails.payment.success');
    }
}