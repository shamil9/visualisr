@component('mail::message')
# Welcome to Visualisr

Your account was succefully created. You can now login to your profile with your credentials.

@component('mail::button', ['url' => route('user.home'))])
Open profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
