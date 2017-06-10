@component('mail::message')
# Message
{{ $message->body }}

By {{ $message->name }} {{  $message->created_at->diffForHumans() }}
@endcomponent
