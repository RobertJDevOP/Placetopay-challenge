@extends('layouts.auth')
@section('auth-content')
    <div class="card">
        <div class="card-content">
                            <caption>Sign up</caption>
            <form action="{{"/register"}}" method="POST">
                @csrf
                <b-field label='Full name' type="{{ $errors->has('name') ? 'is-danger' : null }}" message="{{ $errors->first('name') }}">
                    <b-input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="255"  required></b-input>
                </b-field>

                <b-field label='Email' type="{{ $errors->has('email') ? 'is-danger' : null }}" message="{{ $errors->first('email') }}">
                    <b-input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="255" icon="account-lock"  required></b-input>
                </b-field>

                <b-field label='Password' type="{{ $errors->has('password') ? 'is-danger' : null }}" message="{{ $errors->first('password') }}">
                    <b-input type="password" name="password" id="password" value="{{ old('password') }}" maxlength="255" icon="lock" required></b-input>
                </b-field>

                <b-field label='Password confirmation'  type="{{ $errors->has('password_confirmation') ? 'is-danger' : null }}" message="{{ $errors->first('password_confirmation') }}">
                    <b-input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" maxlength="255" icon="lock" required></b-input>
                </b-field>

                <button type="submit" class="button is-warning is-fullwidth"> <b-icon pack="fas" icon="save"></b-icon>&nbsp;
                    Sign up
                </button>
            </form>

   </div>
 </div>
@endsection
