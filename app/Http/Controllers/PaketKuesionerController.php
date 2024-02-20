<?php
// app/Http/Controllers/PaketKuesionerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketKuesioner;

class PaketKuesionerController extends Controller
{
    public function index()
    {
        $paketKuesioners = PaketKuesioner::all();
        return view('admin.paket_kuesioner.index', compact('paketKuesioners'));
    }

    public function create()
    {
        return view('admin.paket_kuesioner.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tipe' => 'required|in:Tracer Study,Survey Khusus',
            'tanggal_dibuat' => 'required|date',
            'program_studi' => $request->input('tipe') == 'Survey Khusus' ? 'required' : '',
        ]);

        PaketKuesioner::create($validatedData);

        return redirect()->route('paket_kuesioner.index')->with('success', 'Paket Kuesioner berhasil dibuat');
    }

    public function edit($id)
    {
        $paketKuesioner = PaketKuesioner::findOrFail($id);
        return view('admin.paket_kuesioner.edit', compact('paketKuesioner'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tipe' => 'required|in:Tracer Study,Survey Khusus',
            'tanggal_dibuat' => 'required|date',
            'program_studi' => $request->input('tipe') == 'Survey Khusus' ? 'required' : '',
        ]);

        $paketKuesioner = PaketKuesioner::findOrFail($id);
        $paketKuesioner->update($validatedData);

        return redirect()->route('paket_kuesioner.index')->with('success', 'Paket Kuesioner berhasil diperbarui');
    }

    public function destroy($id)
    {
        $paketKuesioner = PaketKuesioner::findOrFail($id);
        $paketKuesioner->delete();

        return redirect()->route('paket_kuesioner.index')->with('success', 'Paket Kuesioner berhasil dihapus');
    }
}
