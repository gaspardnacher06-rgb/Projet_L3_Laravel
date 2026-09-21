@extends('layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Boutique</h1>
    </div>

    @if(request('q'))
        <p>
            Résultats pour « {{ request('q') }} »
            <a href="{{ route('boutique') }}" class="ml-2">(réinitialiser)</a>
        </p>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Pas+d%27image" class="card-img-top" alt="Pas d'image">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                        <p class="card-text"><strong>{{ number_format($article->price, 2) }} €</strong></p>

                        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary mt-auto mb-2">Voir le produit</a>

                        @auth
                            <form action="{{ route('panier.ajouter', $article) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">Ajouter au panier</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-block">Se connecter pour acheter</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Aucun article disponible pour le moment.</p>
            </div>
        @endforelse
    </div>

@endsection