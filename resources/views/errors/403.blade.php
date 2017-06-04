@extends('layouts.app')
@section('title', 'Action Unauthorized')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index'])
@endsection

@section('content')
    <div class="error">
        <span class="error__number">You shall not pass</span>
        <span class="error__text">Action Unauthorized</span>
    </div>
@stop
