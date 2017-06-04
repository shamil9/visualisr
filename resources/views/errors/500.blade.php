@extends('layouts.app')
@section('title', 'Server Error')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index'])
@endsection

@section('content')
    <div class="error">
        <span class="error__number">Our Bad</span>
        <span class="error__text">Server Error</span>
    </div>
@stop
