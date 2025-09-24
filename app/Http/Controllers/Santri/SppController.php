<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Spp;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class SppController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:admin|santri')->only(['index', 'show', 'showDetail']);
        $this->middleware('role:admin')->except(['index', 'show', 'showDetail']);
    }

    public function index()
    {
        $user = Auth::user();


        if ($user->hasRole('santri')) {
            $santri = $user->santri;

            if (!$santri) {
                abort(403, 'Santri tidak ditemukan.');
            }

            $spp = Spp::with(['santri'])
                ->where('id_santri', $santri->id_santri)
                ->latest()
                ->paginate(10);
        } elseif ($user->hasRole('admin')) {
        }
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $admin = $user->admin;

        $kelasList = Kelas::all();
        $id_kelas = $request->input('id_kelas');

        $santris = collect(); // default kosong
        if ($id_kelas) {
            $santris = Santri::where('id_kelas', $id_kelas)->where('status', '!=', 'calon')->get();
        }
        // $santris = Santri::where('status', '!=', 'calon')->get();
        return view('spp.sppcreate', compact('santris', 'kelasList', 'id_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|exists:santris,id_santri',
        ]);

        // Buat Spp dengan nilai default untuk kolom tambahan
        Spp::create([
            'id_santri' => $request->id_santri,
            'bulan' => null,
            'tahun' => null,
            'status' => "Belum", // misal ini adalah default
        ]);

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $spp = Spp::findOrFail($id);
        $santris = Santri::where('status', '!=', 'calon')->get();
        return view('hapalan.hapalanedit', compact('hapalan', 'santris', 'gurus', 'levelHapalan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'bulan' => 'nullable|string|min:1|max:10',
            'tahun' => 'nullable|string|min:1|max:10',
            'status' => 'nullable|string|min:1|max:10',
        ]);

        $spp = Spp::findOrFail($id);
        $spp->update([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'status' => $request->status,
        ]);
        return redirect()->route('hapalan.index')->with('success', 'Juz dan level hafalan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil dihapus.');
    }
}
