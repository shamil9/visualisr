@extends('layouts.app')
@section('title', $visual->track)

@section('control-bar')
    @if($visual->user->canManage($visual->user))
        <span>{{ $visual->track . " / " . $visual->artist . " / " . $visual->album }}</span>
        <span><a href="{{ route('visuals.edit', ['visual' => $visual]) }}">Edit</a></span>
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
        <form id="delete-form" action="{{ route('visuals.destroy', ['visual' => $visual->id]) }}" method="POST" style="display: none;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
        <form id="update-form" action="{{ route('visuals.update', ['visual' => $visual->id]) }}" method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            Track <input type="text" name="track" value="{{ $visual->track }}">
            Artist <input type="text" name="artist" value="{{ $visual->artist }}">
            Album <input type="text" name="album" value="{{ $visual->album }}">
        </form>
    </div>
@endsection

@section('footer-js')
    @parent
@endsection