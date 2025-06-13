<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Guru;
use App\Models\Santri;
use App\Models\Hapalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HapalanDetail;

class HapalanController extends Controller
{

    public function __construct()
    {
    $this->middleware('role:guru|santri')->only(['index', 'show']);
    $this->middleware('role:guru')->except(['index', 'show']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('santri')) {
            $santri = $user->santri;

            if (!$santri) {
                abort(403, 'Santri tidak ditemukan.');
            }

            $hapalans = Hapalan::with(['santri', 'guru'])
                ->where('id_santri', $santri->id_santri)
                ->latest()
                ->paginate(10);
        } elseif ($user->hasRole('guru')) {
            $hapalans = Hapalan::with(['santri', 'guru'])
                ->latest()
                ->paginate(10);
        } else {
            // admin tidak boleh akses
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return view('hapalan.hapalan', compact('hapalans'));
    }

    public function create()
    {
        $santris = Santri::where('status', '!=', 'calon')->get();
        $gurus = Guru::all();
        return view('hapalan.hapalancreate', compact('santris', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|exists:santris,id_santri',
            'id_guru' => 'required|exists:gurus,id_guru',
            // 'keterangan' => 'required|string',
        ]);

        Hapalan::create($request->all());

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $hapalan = Hapalan::findOrFail($id);
        $santris = Santri::where('status', '!=', 'calon')->get();
        $gurus = Guru::all();
        return view('hapalan.hapalanedit', compact('hapalan', 'santris', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_santri' => 'required|exists:santris,id_santri',
            'id_guru' => 'required|exists:gurus,id_guru',
            // 'keterangan' => 'required|string',
        ]);

        $hapalan = Hapalan::findOrFail($id);
        $hapalan->update($request->all());

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hapalan = Hapalan::findOrFail($id);
        $hapalan->delete();

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil dihapus.');
    }

    // === Bagian Detail Hapalan ===

    public function showDetail($id)
    {
        $hapalan = Hapalan::with(['santri', 'guru', 'details'])->findOrFail($id);
        return view('hapalan.hapalandetail', compact('hapalan'));
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
        ]);

        HapalanDetail::create([
            'id_hapalan' => $id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('hapalan.detail', $id)->with('success', 'Detail hapalan berhasil ditambahkan.');
    }

    public function editDetail($id)
    {
        $detail = HapalanDetail::findOrFail($id);
        return view('hapalan.hapalandetailedit', compact('detail'));
    }

    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
        ]);

        $detail = HapalanDetail::findOrFail($id);
        $detail->update(['keterangan' => $request->keterangan]);

        return redirect()->route('hapalan.detail', $detail->id_hapalan)->with('success', 'Detail hapalan berhasil diperbarui.');
    }

    public function destroyDetail($id)
    {
        $detail = HapalanDetail::findOrFail($id);
        $id_hapalan = $detail->id_hapalan;
        $detail->delete();

        return redirect()->route('hapalan.detail', $id_hapalan)->with('success', 'Detail hapalan berhasil dihapus.');
    }
}
