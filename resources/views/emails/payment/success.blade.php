@component('mail::message')
# Payment Successful ✅

Hi {{ $form->name }},

Congratulations! Your payment for the **Social Media Management Blueprint** has been successfully received.

You now have full access to the program. Click the button below to get started:

<!-- @component('mail::button', ['url' => 'https://www.kingsdigihub.org/smm-blueprint'])
Start Learning
@endcomponent -->

You will receive an email soon with more detailed instructions.

Thank you for trusting us to guide you in building your social media management skills.

Best regards,  
**KingsDigiHub Team**
@endcomponent
