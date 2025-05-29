<?php

namespace App\Http\Controllers\Agenda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisAgenda;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::with(['jenisAgenda'])->latest()->paginate(5);
        return view('Agenda_Ponpes.Agenda', compact('agenda'));
    }

    public function create()
    {
        $jenisAgenda = JenisAgenda::all();
        return view('Agenda_Ponpes.AgendaCreate', compact('jenisAgenda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_agenda' => 'required|exists:jenis_agendas,id_jenis_agenda',
            'judul' => 'required|max:50',
            'deskripsi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        Agenda::create($request->all());

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $jenisAgenda = JenisAgenda::all();
        return view('Agenda_Ponpes.AgendaEdit', compact('agenda', 'jenisAgenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis_agenda' => 'required|exists:jenis_agendas,id_jenis_agenda',
            'judul' => 'required|max:50',
            'deskripsi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function showDetail($id)
    {
        $agenda = Agenda::with(['jenisAgenda'])->findOrFail($id);

        return response()->json([
            'judul' => $agenda->judul,
            'kategori' => optional($agenda->jenisAgenda)->jenis_agenda,
            'deskripsi' => $agenda->deskripsi,
            'tanggal_mulai' => \Carbon\Carbon::parse($agenda->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_akhir' => \Carbon\Carbon::parse($agenda->tanggal_akhir)->translatedFormat('d F Y'),
        ]);
    }
}
