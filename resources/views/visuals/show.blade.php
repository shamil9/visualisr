@extends('layouts.app')
@section('title', 'New Visual')

@section('control-bar')
    @if($visual->user->canManage($visual->user))
        <span>{{ $visual->track . " / " . $visual->artist . " / " . $visual->album }}</span>
        <span><a href="{{ route('visuals.edit', ['visual' => $visual]) }}">edit</a></span>
        <span class="visual__save">
        <a href="#" onclick="event.preventDefault();
                document.getElementById('update-form').submit();">
            <img src="{{ asset('assets/img/icons/user/confirm.svg') }}" alt="Delete">
        </a>
    </span>
    <span class="visual__remove">
        <a href="#" onclick="event.preventDefault();
                document.getElementById('delete-form').submit();">
            <img src="{{ asset('assets/img/icons/user/trash.svg') }}" alt="Delete">
        </a>
    </span>
    @endif
@endsection

@section('content')
    <div class="section">
        <div class="visual">
            <img src="{{ asset('uploads/visuals/' . $visual->user->id . '/' . $visual->image) }}" alt="{{ $visual->track }}">
        </div>
        <form id="delete-form" action="{{ route('visuals.destroy', ['visual' => $visual->id]) }}" method="POST" style="display: none;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
        <form id="update-form" action="{{ route('visuals.update', ['visual' => $visual->id]) }}" method="POST" style="display: none;">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
        </form>
    </div>
@endsection

@section('footer-js')
    @parent
@endsection