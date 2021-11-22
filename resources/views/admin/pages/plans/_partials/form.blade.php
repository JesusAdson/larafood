@include('admin.includes.alerts')

<div class="form-group">
    <label for="Nome"></label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="Preço"></label>
    <input type="text" name="price" class="form-control" placeholder="Preço" value="{{ $plan->name ?? old('price') }}">
</div>
<div class="form-group">
    <label for="Descrição"></label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $plan->name ?? old('description') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Enviar</button>
</div>
