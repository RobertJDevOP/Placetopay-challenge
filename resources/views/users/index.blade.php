@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable is-fullwidth">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">created_at</th>
            <th scope="col">status</th>
            <th scope="col">options</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->date_formatted }}</td>
                <td>{{ $user->status }}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->render('partials.pagination.paginator') }}
@endsection
