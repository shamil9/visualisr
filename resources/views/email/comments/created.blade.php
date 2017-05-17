@component('mail::message')
# Hello {{ $comment->user->name }}

One of yours visuals received a comment.
> {{ $comment->body }}

@component('mail::button', ['url' => route('visuals.show', $comment->visual)])
Open visual
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
