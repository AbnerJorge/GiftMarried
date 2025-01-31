@extends('layouts.app')
@section('title', 'Editar Regalo')
@section('content')
    <h2 class="text-center">Editar Regalo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('gifts.update', $gift->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Regalo</label>
            <input type="text" class="form-control" name="name" value="{{ $gift->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" name="price" value="{{ $gift->price }}" required>
        </div>

        <div class="mb-3">
            <label for="is_available" class="form-label">Disponible</label>
            <select class="form-control" name="is_available">
                <option value="1" {{ $gift->is_available ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$gift->is_available ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('gifts.index') }}" class="btn btn-secondary">Volver</a>
    </form>
@endsection
