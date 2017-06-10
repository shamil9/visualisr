@component('mail::message')
# Account Active

We are happy to inform you that your account has been unblocked.

You may now login and use your account.

@component('mail::button', ['url' => route('user.home')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
