@extends('layout')

@section('content')

    <h1 class="mb-4">Mon panier</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Ton panier est vide.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->article->title }}</td>
                        <td>{{ number_format($item->article->price, 2) }} €</td>
                        <td>
                            <form action="{{ route('panier.update', $item) }}" method="POST" class="form-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px; display:inline-block;">
                                <button type="submit" class="btn btn-sm btn-outline-secondary ml-2">Mettre à jour</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->quantity * $item->article->price, 2) }} €</td>
                        <td>
                            <form action="{{ route('panier.remove', $item) }}" method="POST" onsubmit="return confirm('Retirer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-right">Total : {{ number_format($total, 2) }} €</h4>
    @endif

@endsection