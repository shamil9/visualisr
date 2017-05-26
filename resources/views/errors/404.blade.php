@extends('layouts.app')
@section('title', 'Page Not Found')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index'])
@endsection

@section('content')
    <div class="error">
        <span class="error__number">404</span>
        <span class="error__text">Page Not Found</span>
    </div>
@stop
