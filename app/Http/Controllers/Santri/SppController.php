<?php

namespace App\Http\Controllers\Santri;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SppController extends Controller
{
        public function __construct()
    {
        $this->middleware('role:admin')->only(['index', 'edit', 'update']);
    }

    public function index(Request $request)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $query = Spp::with('santri.kelas');

        // FILTER NAMA
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('santri', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%");
            });
        }

        // FILTER KELAS
        if ($request->filled('kelas')) {
            $query->whereHas('santri', function($q) use ($request) {
                $q->where('id_kelas', $request->kelas);
            });
        }

        // FILTER BULAN
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        // FILTER TAHUN
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }


    if ($request->filled('kelas') && $request->filled('bulan') && $request->filled('tahun')) {

        // Ambil hanya santri aktif, bukan calon
        $santriKelas = Santri::where('id_kelas', $request->kelas)
                            ->where('status', 'santri')
                            ->get();

        foreach ($santriKelas as $santri) {

            Spp::firstOrCreate(
                [
                    'id_santri' => $santri->id_santri,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun
                ],
                [
                    'status' => 'belum'
                ]
            );
        }
    }

        $spp = $query->orderBy('tahun', 'desc')
                    ->orderBy('bulan', 'desc')
                    ->paginate(12)
                    ->withQueryString();


        return view('Santri.spp', compact('spp', 'kelas'));
    }

    public function edit($id)
    {
        $spp = Spp::with('santri')->findOrFail($id);

        return view('Santri.sppedit', compact('spp'));
    }

    public function update(Request $request, $id)
    {
        $spp = Spp::findOrFail($id);

        $request->validate([
            'status' => 'required|in:lunas,belum',
        ]);

        DB::beginTransaction();
        try {
            $spp->update([
                'status' => $request->status,
            ]);

            DB::commit();
            return redirect()
            ->route('spp.index', [
                'kelas' => $request->filter_kelas,
                'bulan' => $request->filter_bulan,
                'tahun' => $request->filter_tahun,
                'status' => $request->filter_status,
            ])
            ->with('success', 'Data SPP berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal update SPP: ' . $e->getMessage()]);
        }
    }

    public function showDetail($id)
    {
        $spp = Spp::with('santri.kelas')->findOrFail($id);

        return view('Santri.sppdetail', compact('spp'));
    }
}
