@extends('layouts.admin')
@section('content')
    @if (\Session::has('success'))
        <b-message
            title="Success"
            type="is-success"
            aria-close-label="Close message">
            {!! \Session::get('success') !!}
        </b-message>
    @endif
    <div class="level-left">
        <h1 class="title">Update client</h1>
    </div>
    <div class="card">
        <div class="card-content">

            <form action="/users/{{$user->email}}" method="POST">
                @csrf
                @method('PUT')
                <b-field label='Full name' >
                    <b-input type="text" name="name" id="name" value="{{$user->name}}" maxlength="255" ></b-input>
                </b-field>

                <b-field label='Email'>
                    <b-input type="email" name="email" id="email" value="{{$user->email}}"maxlength="255" icon="account-lock"  disabled="true"></b-input>
                </b-field>
                <div class="columns">
                    <div class="column is-6">
                        <b-button native-type="is-link" tag="a"  href="/users"   class="button is-fullwidth"  type="is-danger is-light">
                            Cancel
                        </b-button>
                    </div>
                    <div class="column is-6">
                        <b-button native-type="submit"  class="button is-fullwidth"  type="is-warning is-light">
                            Update client
                        </b-button>
                        </div>
                    </div>
            </form>

        </div>
    </div>

@endsection
