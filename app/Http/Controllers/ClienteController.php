<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    public function index(Request $request): View
    {
        $query = Cliente::query();

        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function($q) use ($busqueda) {
                $q->where('nombre', 'like', "%{$busqueda}%")
                  ->orWhere('email', 'like', "%{$busqueda}%")
                  ->orWhere('empresa', 'like', "%{$busqueda}%")
                  ->orWhere('telefono', 'like', "%{$busqueda}%");
            });
        }

        if ($request->filled('tipo') && $request->input('tipo') !== 'todos') {
            $query->where('tipo', $request->input('tipo'));
        }

        $clientes = $query->orderBy('nombre')->paginate(12);
        $tipos = Cliente::getTipos();

        return view('clientes.index', compact('clientes', 'tipos'));
    }

    public function create(): View
    {
        $tipos = Cliente::getTipos();
        return view('clientes.create', compact('tipos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'required|string|max:50',
            'empresa' => 'required|string|max:255',
            'tipo' => 'required|in:comprador,arrendatario,ambos',
            'direccion' => 'nullable|string|max:500',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'notas' => 'nullable|string|max:1000'
        ]);

        $validated['activo'] = true;
        $validated['fecha_registro'] = now();

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    public function show(Cliente $cliente): View
    {
        $cliente->load(['licencias.producto', 'transacciones']);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente): View
    {
        $tipos = Cliente::getTipos();
        return view('clientes.edit', compact('cliente', 'tipos'));
    }

    public function update(Request $request, Cliente $cliente): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required|string|max:50',
            'empresa' => 'required|string|max:255',
            'tipo' => 'required|in:comprador,arrendatario,ambos',
            'direccion' => 'nullable|string|max:500',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'notas' => 'nullable|string|max:1000',
            'activo' => 'boolean'
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
