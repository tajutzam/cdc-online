<?php
// app/Http/Controllers/PaketKuesionerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use App\Models\QuesionerType;
use App\Models\QuisionerProdi;
use RealRashid\SweetAlert\Facades\Alert;

use function Symfony\Component\Cache\Traits\auth;

class PaketKuesionerController extends Controller
{

    function __construct()
    {
        $this->paketKuesioner = new PaketKuesioner();
    }

    public function index()
    {
        $paketKuesioners = PaketKuesioner::orderBy('id', 'desc')->get();

        if (session('success')) {
            toast(session('success'), 'success');
        } elseif (session('error')) {
            alert('Gagal', 'Paket Gagal Disimpan', 'error');
        }
        confirmDelete("Delete Paket!", "Apakah anda yakin?");
        return view('admin.paket_kuesioner.index', compact('paketKuesioners'));
    }

    public function create()
    {
        $prodi =  QuisionerProdi::all();
        return view('admin.paket_kuesioner.create', compact('prodi'))->with("success", "Data berhasil ditambahakan");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tipe' => 'required|in:Tracer Study,Survey Khusus',
            // 'tanggal_dibuat' => 'required|date',
            'id_quis_identitas_prodi' => $request->input('tipe') == 'Survey Khusus' ? 'required' : '',
        ]);

        if (PaketKuesioner::create($validatedData)) {
            return redirect()->route('paket_kuesioner.index')->with('success', 'Paket Kuesioner berhasil dibuat');
        }
        return redirect()->route('paket_kuesioner.index')->with('error', 'paket gagal dibuat');
    }

    public function edit($id)
    {
        $paketKuesioner = PaketKuesioner::findOrFail($id);
        $prodi =  QuisionerProdi::all();
        return view('admin.paket_kuesioner.edit', compact(['paketKuesioner', 'prodi']));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tipe' => 'required|in:Tracer Study,Survey Khusus',
            // 'tanggal_dibuat' => 'required|date',
            'id_quis_identitas_prodi' => $request->input('tipe') == 'Survey Khusus' ? 'required' : '',
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

    function detailKuesioner($id)
    {
        $quiz_type = QuesionerType::all();
        $data = PaketKuesioner::where('id', '=', $id)->first();
        return view('admin.paket_kuesioner.view', compact('data', 'quiz_type'));
    }

    public function changeStatus($id_paket, $status)
    {
        PaketKuesioner::where('id', $id_paket)->update([
            'status' => $status
        ]);

        return redirect()->route('paket_kuesioner.index')->with('success', 'Status Telah Di Perbarui!');
    }

    public function duplicateData($id_paket)
    {
        $data = PaketKuesioner::with(["prodi", "detail.tipe"])->where("id", $id_paket)->first();
        $paket =  PaketKuesioner::create([
            'judul' => $data->judul . "-copy",
            'tipe' => $data->tipe,
            'id_quis_identitas_prodi' => $data->id_quis_identitas_prodi,
            'status' => $data->status
        ]);

        $newId_paket = $paket->id;

        $error = 0;
        try {
            foreach ($data->detail as $d) {
                PaketQuesionerDetail::create([
                    'kode_pertanyaan' => $d->kode_pertanyaan,
                    'pertanyaan' => $d->pertanyaan,
                    'tipe_id' => $d->tipe_id,
                    'id_paket_quesioners' => $newId_paket,
                    'is_required' => $d->is_required,
                    'options' => $d->options,
                    'index' => $d->index
                ]);
            }
        } catch (\Throwable $th) {
            $error++;
        }

        if ($error > 1) {
            return redirect()->route('paket_kuesioner.index')->with('error', 'Data Gagal Di Duplikat!');
        } else {
            return redirect()->route('paket_kuesioner.index')->with('success', 'Data Berhasil Di Duplikat!');
        }
    }
}
