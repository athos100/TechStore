<label>Categoria</label>
<select class="form-control" name="category_id" required>
    <option value="">Selecione</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>
    @endforeach
</select>

<label>Nome</label>
<input class="form-control" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required>

<label>Descricao</label>
<textarea class="form-control" name="description" required>{{ old('description', $product->description ?? '') }}</textarea>

<label>Preco</label>
<input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required>

<label>Estoque</label>
<input class="form-control" type="number" name="stock" min="0" value="{{ old('stock', $product->stock ?? '') }}" required>

<label>Marca</label>
<input class="form-control" type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}">

<label>Imagem</label>
<input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">

<label>Manual PDF</label>
<input class="form-control" type="file" name="manual_pdf" accept="application/pdf,.pdf">

@if(!empty($product?->manual_pdf))
    <p>Manual atual: <a href="{{ asset('storage/' . $product->manual_pdf) }}" target="_blank">abrir</a></p>
@endif
