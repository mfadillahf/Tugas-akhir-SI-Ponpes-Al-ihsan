<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function __construct()
    {
    $this->middleware('role:guru|santri')->only(['index', 'show']);
    $this->middleware('role:guru')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Nilai::with(['santri.kelas', 'mapel']);

        if (Auth::user()->hasRole('santri')) {
            $santri = Auth::user()->santri;

            if ($santri) {
                $query->where('id_santri', $santri->id_santri);

                $mapelList = Mapel::whereIn('id_mapel', function ($q) use ($santri) {
                    $q->select('id_mapel')
                        ->from('nilais')
                        ->where('id_santri', $santri->id_santri);
                })->get();

                $kelasList = $santri->kelas ? collect([$santri->kelas]) : collect();
            } else {
                $query->whereNull('id_santri');
                $mapelList = collect();
                $kelasList = collect();
            }

        } else { // role guru
            $guru = Auth::user()->guru;
            $mapelIds = $guru ? $guru->mapel->pluck('id_mapel')->toArray() : [];

            // Batasi nilai hanya pada mapel yang dia ajar
            $query->whereIn('id_mapel', $mapelIds);

            if ($request->filled('id_kelas')) {
                $query->whereHas('santri', function ($q) use ($request) {
                    $q->where('id_kelas', $request->id_kelas);
                });
            }

            if ($request->filled('id_mapel')) {
                // Filter mapel harus tetap di mapel yg dia ajar juga
                if (in_array($request->id_mapel, $mapelIds)) {
                    $query->where('id_mapel', $request->id_mapel);
                } else {
                    // Kalau filter mapel yg bukan dia ajar, hasil kosong
                    $query->whereRaw('0=1');
                }
            }

            if ($request->filled('tahun_ajaran')) {
                $query->where('tahun_ajaran', $request->tahun_ajaran);
            }

            $mapelList = $guru ? $guru->mapel : collect();
            $kelasList = Kelas::all();
        }

        return view('nilai.nilai', [
            'nilaiList' => $query->latest()->paginate(10),
            'kelasList' => $kelasList,
            'mapelList' => $mapelList,
        ]);
    }

    public function create(Request $request)
    {
        $id_kelas = $request->id_kelas;
        $id_mapel = $request->id_mapel;
        $tahun_ajaran = $request->tahun_ajaran;
        $santris = collect();

        if ($id_kelas && $id_mapel && $tahun_ajaran) {
            $santris = Santri::where('id_kelas', $id_kelas)->get();
        }

        $guru = Auth::user()->guru;
        $mapelList = $guru ? $guru->mapel : collect();

        return view('nilai.nilaicreate', [
            'kelasList' => Kelas::all(),
            'mapelList' => $mapelList,
            'santris' => $santris,
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'tahun_ajaran' => $tahun_ajaran,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_mapel' => 'required|exists:mapels,id_mapel',
            'tahun_ajaran' => 'required|string|max:10',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        $guru = Auth::user()->guru;
        if (!$guru || !$guru->mapel->contains('id_mapel', $request->id_mapel)) {
            return back()->with('error', 'Anda tidak berhak menginput nilai untuk mapel ini.');
        }

        DB::beginTransaction();
        try {
            foreach ($request->nilai as $id_santri => $nilai) {
                Nilai::updateOrCreate(
                    [
                        'id_santri' => $id_santri,
                        'id_mapel' => $request->id_mapel,
                        'tahun_ajaran' => $request->tahun_ajaran,
                    ],
                    ['nilai' => $nilai]
                );
            }
            DB::commit();
            return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $nilai = Nilai::with(['santri.kelas', 'mapel'])->findOrFail($id);

        $guru = Auth::user()->guru;
        if (!$guru || !$guru->mapel->contains('id_mapel', $nilai->id_mapel)) {
            abort(403, 'Anda tidak berhak mengedit nilai ini.');
        }

        return view('nilai.nilaiedit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $guru = Auth::user()->guru;
        if (!$guru || !$guru->mapel->contains('id_mapel', $nilai->id_mapel)) {
            abort(403, 'Anda tidak berhak mengupdate nilai ini.');
        }

        $nilai->update(['nilai' => $request->nilai]);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $guru = Auth::user()->guru;
        if (!$guru || !$guru->mapel->contains('id_mapel', $nilai->id_mapel)) {
            abort(403, 'Anda tidak berhak menghapus nilai ini.');
        }

        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

}
