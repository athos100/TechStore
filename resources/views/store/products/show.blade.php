@extends('layouts.app')

@section('content')
<article class="card section">
    <h1>{{ $product->name }}</h1>

    @if($product->main_image)
        <div class="product-gallery" data-gallery>
            <div class="product-detail-image-wrap">
                <img
                    id="main-product-image"
                    src="{{ asset('storage/' . $product->main_image) }}"
                    class="product-detail-image"
                    alt="{{ $product->name }}"
                    data-images='@json(array_map(fn ($img) => asset("storage/" . $img), $product->gallery_images))'
                >
            </div>
            @if(count($product->gallery_images) > 1)
                <button type="button" class="gallery-btn prev" data-prev aria-label="Imagem anterior">‹</button>
                <button type="button" class="gallery-btn next" data-next aria-label="Próxima imagem">›</button>
            @endif
        </div>

        @if(count($product->gallery_images) > 1)
            <div class="thumbs">
                @foreach($product->gallery_images as $index => $img)
                    <img
                        src="{{ asset('storage/' . $img) }}"
                        alt="Imagem de {{ $product->name }}"
                        data-thumb-index="{{ $index }}"
                    >
                @endforeach
            </div>
        @endif
    @endif

    <p><strong>Categoria:</strong> {{ $product->category->name ?? 'Sem categoria' }}</p>
    <p><strong>Marca:</strong> {{ $product->brand ?: 'Não informada' }}</p>
    <p>{{ $product->description }}</p>
    <p><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    <p><strong>Estoque:</strong> {{ $product->stock }}</p>

    @if($product->manual_pdf)
        <p><a href="{{ asset('storage/' . $product->manual_pdf) }}" target="_blank">Abrir manual em PDF</a></p>
    @endif

    <form method="POST" action="{{ route('cart.add', $product) }}">
        @csrf
        <label>Quantidade</label>
        <input class="form-control" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required>
        <button class="btn" type="submit">Adicionar ao carrinho</button>
    </form>
</article>

<section class="card section">
    <h2>Avaliações dos clientes</h2>

    <div class="review-summary">
        <span class="stars">{{ str_repeat('★', (int) round($averageRating)) }}{{ str_repeat('☆', 5 - (int) round($averageRating)) }}</span>
        <strong>{{ number_format($averageRating, 1, ',', '.') }}/5</strong>
        <span class="muted">({{ $reviewsCount }} {{ $reviewsCount === 1 ? 'avaliação' : 'avaliações' }})</span>
    </div>

    @auth
        @if($canReview)
        <div class="card" style="background:#f8fafc;">
            <h3>{{ $userReview ? 'Sua avaliação (editar)' : 'Deixe sua avaliação' }}</h3>

            <form method="POST" action="{{ route('reviews.store', $product) }}">
                @csrf
                <label>Nota (1 a 5)</label>
                <select class="form-control" name="rating" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected((int) old('rating', $userReview->rating ?? 5) === $i)>{{ $i }} estrela{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>

                <label>Comentário</label>
                <textarea class="form-control" name="comment" rows="4" placeholder="Conte sua experiência com este produto...">{{ old('comment', $userReview->comment ?? '') }}</textarea>
                <button class="btn" type="submit">{{ $userReview ? 'Atualizar avaliação' : 'Enviar avaliação' }}</button>
            </form>

            @if($userReview)
                <form method="POST" action="{{ route('reviews.destroy', $product) }}" style="margin-top:8px;">
                    @csrf
                    @method('DELETE')
                    <button class="btn secondary" type="submit">Remover minha avaliação</button>
                </form>
            @endif
        </div>
        @else
            <p class="muted">Você poderá avaliar este produto após a entrega.</p>
        @endif
    @else
        <p>Faça <a href="{{ route('login') }}">login</a> para avaliar este produto.</p>
    @endauth

    <div style="margin-top:14px;">
        @forelse($reviews as $review)
            <article class="review-item">
                <p><strong>{{ $review->user->name }}</strong> <span class="muted">em {{ $review->created_at->format('d/m/Y H:i') }}</span></p>
                <p class="stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</p>

                @if($review->comment)
                    <p>{{ $review->comment }}</p>
                @else
                    <p class="muted">Sem comentário.</p>
                @endif
            </article>
        @empty
            <p class="muted">Este produto ainda não possui avaliações.</p>
        @endforelse

        @if($reviews->hasPages())
            <div class="section" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                @if($reviews->onFirstPage())
                    <span class="btn secondary" style="opacity:.55;cursor:not-allowed;">Anterior</span>
                @else
                    <a class="btn secondary" href="{{ $reviews->previousPageUrl() }}">Anterior</a>
                @endif

                <span class="muted">Página {{ $reviews->currentPage() }} de {{ $reviews->lastPage() }}</span>

                @if($reviews->hasMorePages())
                    <a class="btn secondary" href="{{ $reviews->nextPageUrl() }}">Próxima</a>
                @else
                    <span class="btn secondary" style="opacity:.55;cursor:not-allowed;">Próxima</span>
                @endif
            </div>
        @endif
    </div>
</section>

@if(count($product->gallery_images) > 1)
<script>
(() => {
    const mainImage = document.getElementById('main-product-image');
    if (!mainImage) return;

    const images = JSON.parse(mainImage.dataset.images || '[]');
    let index = 0;
    const thumbs = Array.from(document.querySelectorAll('[data-thumb-index]'));
    const prevBtn = document.querySelector('[data-prev]');
    const nextBtn = document.querySelector('[data-next]');

    const update = () => {
        mainImage.src = images[index];
        thumbs.forEach((thumb, i) => {
            thumb.style.outline = i === index ? '2px solid #0b5ed7' : 'none';
        });
    };

    prevBtn?.addEventListener('click', () => {
        index = (index - 1 + images.length) % images.length;
        update();
    });

    nextBtn?.addEventListener('click', () => {
        index = (index + 1) % images.length;
        update();
    });

    thumbs.forEach((thumb, i) => {
        thumb.addEventListener('click', () => {
            index = i;
            update();
        });
    });

    update();
})();
</script>
@endif
@endsection
