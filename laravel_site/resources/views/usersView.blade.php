@extends('layouts.app')

@section('content')
<table>

    @foreach ($users as $aUser)
        <tr>
            <td>{{ $aUser->id }}</td><td> {{ $aUser->name }}</td><td>{{ $aUser->profil->nom}}</td>
        </tr>
    @endforeach


</table>

<a href={{route('GestUsers.create')}}>Ajouter un user</a>
@endsection
