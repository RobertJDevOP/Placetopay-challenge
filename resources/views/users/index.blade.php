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
            <th scope="col" class="has-text-centered">name</th>
            <th scope="col" class="has-text-centered">email</th>
            <th scope="col" class="has-text-centered">created at</th>
            <th scope="col" class="has-text-centered">status</th>
            <th scope="col" class="has-text-centered">options</th>
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
                    <b-button tag="a"  href="users/{{$user->email}}/edit"  size="is-small"  type="is-warning is-light"> <span class="icon is-small"><i class="mdi mdi-pencil-outline"></i></span>Edit user</b-button>
                    &nbsp;
                    <form action="users/{{$user->email}}/status" method="POST">
                            @csrf
                            @method('PUT')
                    @if (is_null($user->enabled_at))
                         <b-button  size="is-small"  name="validation" value="enabled" type="is-success is-light" native-type="submit">
                             <span class="icon is-small"><i class="mdi mdi-check"></i></span>
                             Enabled user
                         </b-button>
                    @else
                            <b-button  size="is-small" name="validation"  value="disabled" type="is-danger is-light" native-type="submit">
                                <span class="icon is-small"><i class="mdi mdi-close"></i></span>
                            Disabled user
                        </b-button>
                    @endif
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->render('partials.pagination.paginator') }}
@endsection
