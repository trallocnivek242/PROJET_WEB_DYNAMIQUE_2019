@extends('layouts.app')

@section('content')
    <form action="{{ route('GestUsers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control  @error('nom') is-invalid @enderror" name="nom" id="nom" placeholder="Le nom" value="{{ old('nom') }}">
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="L'email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Le mot de passe" value="{{ old('password') }}">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--//créer une combo qui contient les différent profil, nom et description, lu de la db-->
        <div class="form-group">
            <select name="profil" class="form-control @error('password') is-invalid @enderror" name="profil" id="profil" placeholder="Le profil" value="{{ old('profil') }}">
                @foreach ($profils as $aProfil)
            <option value='{{ $aProfil->id }}'>{{ $aProfil->nom }}</option>
                @endforeach

              </select>
              @error('profil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Envoyer !">
    </form>
@endsection
