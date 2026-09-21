<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Affiche le panier de l'utilisateur connecté.
     */
    public function index(): View
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('article')->get();
        $total = $cartItems->sum(fn ($item) => $item->quantity * $item->article->price);

        return view('panier', compact('cartItems', 'total'));
    }

    /**
     * Ajoute un article au panier (ou incrémente sa quantité s'il y est déjà).
     */
    public function add(Article $article): RedirectResponse
    {
        $cartItem = CartItem::firstOrNew([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
        ]);

        $cartItem->quantity = ($cartItem->quantity ?? 0) + 1;
        $cartItem->save();

        return back()->with('success', 'Article ajouté au panier.');
    }

    /**
     * Met à jour la quantité d'un article du panier.
     */
    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Quantité mise à jour.');
    }

    /**
     * Retire un article du panier.
     */
    public function remove(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);

        $cartItem->delete();

        return back()->with('success', 'Article retiré du panier.');
    }

    /**
     * Vérifie que l'article du panier appartient bien à l'utilisateur connecté.
     */
    private function authorizeItem(CartItem $cartItem): void
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }
    }
}