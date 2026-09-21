@extends('layout')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Ajouter un article</a>
    </div>

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

                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-secondary">Voir</a>
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-outline-warning">Modifier</a>

                            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Aucun article pour le moment.</p>
            </div>
        @endforelse
    </div>

@endsection