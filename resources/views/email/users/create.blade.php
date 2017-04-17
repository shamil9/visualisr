@component('mail::message')
# Welcome to Visualisr

Your account was succefully created. You can now login to your profile using these credentials.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
