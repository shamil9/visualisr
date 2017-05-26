@component('mail::message')
# Please confirm your email address

Your registration is almost complete, please confirm your email address by clicking "Confirm Email" button.

@component('mail::button', ['url' => route('user.confirm', ['token' => $unconfirmedUser->token])])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
