@extends('layouts/app')
@section('class', 'home')
@section('content')
    <div class="section" id="app">
        <div class="columns">
            <div class="column is-2">
                <aside class="menu">
                    <p class="menu-label">General</p>
                    <ul class="menu-list">
                        <li>
                            <a href="{{ route('user.home') }}">Visuals</a>
                        </li>
                        <li>
                            <a href="{{ route('user.favorites') }}">Favorites</a>
                        </li>
                    </ul>
                    @if ($user->admin)
                        <p class="menu-label">Administration</p>
                        <ul class="menu-list">
                            <li><a>Team Settings</a></li>
                            <li>
                                <a class="is-active">Manage Your Team</a>
                                <ul>
                                    <li><a>Members</a></li>
                                    <li><a>Plugins</a></li>
                                    <li><a>Add a member</a></li>
                                </ul>
                            </li>
                            <li><a>Invitations</a></li>
                            <li><a>Cloud Storage Environment Settings</a></li>
                            <li><a>Authentication</a></li>
                        </ul>
                    @endif
                    <p class="menu-label">Transactions</p>
                    <ul class="menu-list">
                        <li><a>Payments</a></li>
                        <li><a>Transfers</a></li>
                        <li><a>Balance</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column">
                <div class="columns home__title">
                    <h1 class="title is-1">Visuals</h1>
                    <a class="home__plus" href="{{ route('visuals.create') }}">
                        <img src="{{ asset('assets/img/icons/user/plus.svg') }}" alt="Add Visual">
                    </a>
                </div>
                <div class="columns is-multiline">
                    @each('visuals.partials.visual', $visuals, 'visual')
                </div>
            </div>
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </div>
@endsection
@section('footer-js')
@parent
<script>
    new Vue({
        el: '#app'
    });
</script>
@endsection
