<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();
        
        $query = Nilai::with(['santri', 'santri.kelas', 'mapel']);

        if ($request->filled('id_kelas')) {
            $query->whereHas('santri', function ($q) use ($request) {
                $q->where('id_kelas', $request->id_kelas);
            });
        }

        if ($request->filled('id_mapel')) {
            $query->where('id_mapel', $request->id_mapel);
        }

        // Kalau ada filter tahun ajaran juga bisa ditambahkan (misal)
        if ($request->filled('tahun_ajaran')) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $nilaiList = $query->paginate(10);

        return view('nilai.nilai', compact('kelasList', 'mapelList', 'nilaiList'));
    }

    public function create(Request $request)
    {
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();
        $santris = collect();

        $id_kelas = $request->id_kelas;
        $id_mapel = $request->id_mapel;
        $tahun_ajaran = $request->tahun_ajaran;

        if ($id_kelas && $id_mapel && $tahun_ajaran) {
            $santris = Santri::where('id_kelas', $id_kelas)->get();
        }

        return view('nilai.nilaicreate', compact(
            'kelasList',
            'mapelList',
            'santris',
            'id_kelas',
            'id_mapel',
            'tahun_ajaran'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_mapel' => 'required|exists:mapels,id_mapel',
            'tahun_ajaran' => 'required|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->nilai as $id_santri => $nilai) {
                Nilai::updateOrCreate(
                    [
                        'id_santri' => $id_santri,
                        'id_mapel' => $request->id_mapel,
                        'tahun_ajaran' => $request->tahun_ajaran,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }

            DB::commit();

            return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menyimpan nilai: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $nilai = Nilai::with(['santri', 'mapel', 'santri.kelas'])->findOrFail($id);
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();

        return view('nilai.nilaiedit', compact('nilai', 'kelasList', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);

        $nilai->nilai = $request->nilai;
        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

}
