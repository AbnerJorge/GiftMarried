<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GiftSelectionRequest;
use App\Models\Gift;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::where('is_available', true)->get();
        return view('gifts.index', compact('gifts'));
    }

    public function create()
    {
        return view('gifts.create');
    }

    public function store(GiftSelectionRequest $request)
    {
        // Verificar si el regalo ya fue tomado en tiempo real
        if (!Gift::where('id', $request->gift_id)->where('is_available', true)->exists()) {
            return back()->withErrors(['gift_id' => 'El regalo ya fue tomado por otra persona.']);
        }

        // Guardar usuario (nombre)
        $user = User::create([
            'name' => $request->name,
            'email' => null
        ]);

        // Guardar imagen del comprobante de pago
        $paymentProofPath = $request->file('payment_proof')->store('payments', 'public');

        // Registrar la selección del regalo
        GiftSelection::create([
            'user_id' => $user->id,
            'gift_id' => $request->gift_id,
            'payment_method' => $request->payment_method,
            'payment_proof_url' => $paymentProofPath
        ]);

        // Marcar el regalo como no disponible
        Gift::where('id', $request->gift_id)->update(['is_available' => false]);

        return redirect()->route('gifts.index')->with('success', 'Tu respuesta se registró exitosamente.');
    }

    public function edit($id)
    {
        $gift = Gift::findOrFail($id);
        return view('gifts.edit', compact('gift'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean'
        ]);

        $gift = Gift::findOrFail($id);
        $gift->update($request->all());

        return redirect()->route('gifts.index')->with('success', 'Regalo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $gift = Gift::findOrFail($id);

        // Verificar si el regalo ya fue seleccionado
        if (GiftSelection::where('gift_id', $id)->exists()) {
            return redirect()->route('gifts.index')->with('error', 'No se puede eliminar un regalo que ya fue seleccionado.');
        }

        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'Regalo eliminado correctamente.');
    }
}
