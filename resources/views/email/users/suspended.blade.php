@component('mail::message')
    # Account Suspended

    We are sorry, but your account has been temporarily suspended.

    If you think there was a mistake please feel free to contact us.

    @component('mail::button', ['url' => route('contact.create')])
        Contact Us
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }} Team
@endcomponent
