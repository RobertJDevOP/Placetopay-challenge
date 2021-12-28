@extends('layouts.app')
@push('main')
    <div class="hero has-background-grey is-fullheight">
        <div class="hero-body" id="app">
            <div class="container">
                <div class="columns">
                    <div class="column is-6 is-offset-3">
                        @yield('auth-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
