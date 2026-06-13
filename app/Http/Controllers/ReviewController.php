<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

// Controlador responsável por gerenciar as avaliações dos produtos, permitindo que os usuários autenticados avaliem os produtos que compraram. Ele garante que apenas usuários que receberam o produto possam avaliá-lo, mantendo a integridade das avaliações e proporcionando feedback valioso para outros clientes. O controlador também permite que os usuários atualizem ou removam suas avaliações, garantindo flexibilidade e controle sobre suas opiniões.
class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $canReview = $request->user()->orders()
            ->where('status', 'entregue')
            ->whereHas('items', fn ($q) => $q->where('product_id', $product->id))
            ->exists();

        if (! $canReview) {
            return redirect()
                ->route('store.products.show', $product)
                ->withErrors(['review' => 'Você só pode avaliar este produto após a entrega.']);
        }

        $data = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        Review::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
            ],
            [
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ]
        );

        return redirect()->route('store.products.show', $product)->with('success', 'Avaliação salva com sucesso.');
    }

    public function destroy(Request $request, Product $product)
    {
        Review::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->route('store.products.show', $product)->with('success', 'Avaliação removida com sucesso.');
    }
}
