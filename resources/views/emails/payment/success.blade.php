@component('mail::message')

# 🎉 Welcome to KingsDigiHub!

Hello **{{ $form->name }}**,

Congratulations! Your payment has been successfully confirmed and your learning account is now active.

You now have access to the **Social Media Management Blueprint**, where you'll learn practical strategies, tools, and techniques to build in-demand social media management skills.

@component('mail::panel')

### 🔐 Your Login Details

**Email:** {{ $form->email }}

**Password:** {{ $plainPassword }}
@endcomponent

> For security purposes, we recommend changing your password after your first login.

### What's Next?

✅ Log in to your student dashboard
✅ Access your course materials
✅ Start your lessons at your own pace
✅ Track your learning progress

@component('mail::button', ['url' => 'https://www.kingsdigihub.org/'])
Access My Dashboard
@endcomponent

If you have any questions or need assistance, our support team is always ready to help.

We look forward to being part of your learning journey.

**Happy Learning! 🚀**

Regards,
**KingsDigiHub Team**

@endcomponent
