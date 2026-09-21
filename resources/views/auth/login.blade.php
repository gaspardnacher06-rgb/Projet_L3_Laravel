@extends('layout')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">Connexion</h1>

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <p class="mt-3">Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
        </div>
    </div>

@endsection