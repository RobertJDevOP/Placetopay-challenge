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
        <h1 class="title">Clients</h1>
    </div>

    <table class="table is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th scope="col" class="has-text-centered">Name</th>
            <th scope="col" class="has-text-centered">Email</th>
            <th scope="col" class="has-text-centered">Created at</th>
            <th scope="col" class="has-text-centered">Status</th>
            <th scope="col" class="has-text-centered">Options</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->date_formatted }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <b-button tag="a"  href="users/{{$user->email}}/edit"  size="is-small"  type="is-warning is-light"> <span class="icon is-small"><i class="mdi mdi-pencil-outline"></i></span> Edit user</b-button>
                    &nbsp;
                    <form action="users/{{$user->email}}/status" method="POST">
                            @csrf
                            @method('PUT')
                        <b-button  size="is-small"  name="validation" value="{{$user->status}}" type="is-info is-light" native-type="submit">
                            <span class="icon is-small"><i class="mdi mdi-account"></i></span>
                             Change status
                        </b-button>

                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
