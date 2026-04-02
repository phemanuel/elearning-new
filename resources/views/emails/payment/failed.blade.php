@component('mail::message')
# Payment Failed ❌

Hi {{ $form->name }},

Unfortunately, your payment for the **Social Media Management Blueprint** did not go through.

Please try again by clicking the button below to complete your enrollment:

@component('mail::button', ['url' => 'https://www.kingsdigihub.org/smmblueprint'])
Retry Payment
@endcomponent

If you continue to experience issues, please contact us at **support@kingsdigihub.org**.

Best regards,  
**KingsDigiHub Team**
@endcomponent
