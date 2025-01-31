@extends('layouts.app')
@section('title', 'Lista de Regalos')

@section('content')
    <h2 class="text-center">Selecciona un Regalo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('gifts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Selecciona un regalo</label>
            <select class="form-control" name="gift_id" required>
                <option value="">-- Elige un regalo --</option>
                @foreach($gifts as $gift)
                    @if($gift->is_available)
                        <option value="{{ $gift->id }}">{{ $gift->name }} (S/. {{ $gift->price }})</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Método de Pago</label>
            <select class="form-control" name="payment_method" id="payment_method" required>
                <option value="">-- Selecciona un método --</option>
                <option value="Yape">Yape</option>
                <option value="Transferencia">Transferencia Bancaria</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>

        <div id="yape_info" class="alert alert-info d-none">
            <strong>Pago por Yape:</strong> Nombre: Juan Pérez | Teléfono: 987654321
        </div>

        <div id="transferencia_info" class="alert alert-info d-none">
            <strong>Pago por Transferencia:</strong> Banco BCP: 123-456789-0-12 | CCI: 002-123456789012345678
        </div>

        <div class="mb-3">
            <label class="form-label">Sube el Comprobante</label>
            <input type="file" class="form-control" name="payment_proof" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        document.getElementById('yape_info').classList.add('d-none');
        document.getElementById('transferencia_info').classList.add('d-none');

        if (this.value === 'Yape') {
            document.getElementById('yape_info').classList.remove('d-none');
        } else if (this.value === 'Transferencia') {
            document.getElementById('transferencia_info').classList.remove('d-none');
        }
    });
</script>

</body>
</html>
