@extends('layouts.app')
@section('title', 'Server Error')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index'])
@endsection

@section('content')
    <div class="error">
        <span class="error__number">500</span>
        <span class="error__text">Server Error</span>
    </div>
@stop
