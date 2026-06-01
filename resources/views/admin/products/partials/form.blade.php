<label>Categoria</label>
<select class="form-control" name="category_id" required>
    <option value="">Selecione</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
    @endforeach
</select>

<label>Nome</label>
<input class="form-control" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required>

<label>Descrição</label>
<textarea class="form-control" name="description" required>{{ old('description', $product->description ?? '') }}</textarea>

<label>Preço</label>
<input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required>

<label>Estoque</label>
<input class="form-control" type="number" name="stock" min="0" value="{{ old('stock', $product->stock ?? '') }}" required>

<label style="display:flex;align-items:center;gap:8px;margin-top:10px;">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
    Produto ativo
</label>

<label>Marca</label>
<input class="form-control" type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}">

<label>Imagem 1 (principal)</label>
<input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">

<label>Imagem 2</label>
<input class="form-control" type="file" name="image_2" accept=".jpg,.jpeg,.png,.webp">

<label>Imagem 3</label>
<input class="form-control" type="file" name="image_3" accept=".jpg,.jpeg,.png,.webp">

<label>Manual PDF</label>
<input class="form-control" type="file" name="manual_pdf" accept="application/pdf,.pdf">

@if(!empty($product?->image) || !empty($product?->image_2) || !empty($product?->image_3))
    <p>Imagens atuais:</p>
    <ul>
        @if(!empty($product?->image))
            <li><a href="{{ asset('storage/' . $product->image) }}" target="_blank">Imagem 1</a></li>
        @endif
        @if(!empty($product?->image_2))
            <li><a href="{{ asset('storage/' . $product->image_2) }}" target="_blank">Imagem 2</a></li>
        @endif
        @if(!empty($product?->image_3))
            <li><a href="{{ asset('storage/' . $product->image_3) }}" target="_blank">Imagem 3</a></li>
        @endif
    </ul>
@endif

@if(!empty($product?->manual_pdf))
    <p>Manual atual: <a href="{{ asset('storage/' . $product->manual_pdf) }}" target="_blank">abrir</a></p>
@endif
