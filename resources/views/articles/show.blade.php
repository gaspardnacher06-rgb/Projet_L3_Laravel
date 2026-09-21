@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-5">
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid" alt="{{ $article->title }}">
            @else
                <img src="https://via.placeholder.com/400x300?text=Pas+d%27image" class="img-fluid" alt="Pas d'image">
            @endif
        </div>

        <div class="col-md-7">
            <h1>{{ $article->title }}</h1>
            <p>{{ $article->description }}</p>
            <h3 class="mb-4">{{ number_format($article->price, 2) }} €</h3>

            @auth
                <form action="{{ route('panier.ajouter', $article) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Se connecter pour acheter</a>
            @endauth

            <a href="{{ route('boutique') }}" class="btn btn-link">&larr; Retour à la boutique</a>
        </div>
    </div>

@endsection