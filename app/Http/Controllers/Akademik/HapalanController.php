<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Hapalan;
use App\Models\HapalanKitab;
use App\Models\LevelHapalan;
use Illuminate\Http\Request;
use App\Models\HapalanDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HapalanController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:guru|santri')->only(['index', 'show', 'showDetail', 'showKitab']);
        $this->middleware('role:guru')->except(['index', 'show', 'showDetail', 'showKitab']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('santri')) {
            $santri = $user->santri;

            if (!$santri) {
                abort(403, 'Santri tidak ditemukan.');
            }

            $hapalans = Hapalan::with(['santri', 'guru', 'levelHapalan'])
                ->where('id_santri', $santri->id_santri)
                ->latest()
                ->paginate(10);
        } elseif ($user->hasRole('guru')) {
            $guru = $user->guru;
            $hapalans = Hapalan::with(['santri', 'guru', 'levelHapalan'])
                ->where('id_guru', $guru->id_guru)
                ->latest()
                ->paginate(10);
        } else {
            // admin tidak boleh akses
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        $levelHapalan = LevelHapalan::all();
        return view('hapalan.hapalan', compact('hapalans', 'levelHapalan'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $guru = $user->guru;

        $kelasList = Kelas::all();
        $id_kelas = $request->input('id_kelas');

        $santris = collect(); // default kosong
        if ($id_kelas) {
            $santris = Santri::where('id_kelas', $id_kelas)->where('status', '!=', 'calon')->get();
        }
        // $santris = Santri::where('status', '!=', 'calon')->get();
        return view('hapalan.hapalancreate', compact('santris', 'guru', 'kelasList', 'id_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_santri' => 'required|exists:santris,id_santri',
            'id_guru' => 'required|exists:gurus,id_guru',
        ]);

        // Buat hapalan dengan nilai default untuk kolom tambahan
        Hapalan::create([
            'id_santri' => $request->id_santri,
            'id_guru' => $request->id_guru,
            'juz' => null,
            'id_level_hapalan' => 6, // misal ini adalah default
        ]);

        return redirect()->route('hapalan.index')->with('success', 'Data hapalan berhasil ditambahkan.');
    }

    public function updateJuzLevel(Request $request, $id)
    {
        $request->validate([
            'juz' => 'nullable|string|min:1|max:20',
            'id_level_hapalan' => 'nullable|exists:level_hapalans,id_level_hapalan',
        ]);

        $hapalan = Hapalan::findOrFail($id);
        $hapalan->update([
            'juz' => $request->juz,
            'id_level_hapalan' => $request->id_level_hapalan,
        ]);
        return redirect()->route('hapalan.index')->with('success', 'Juz dan level hafalan berhasil diperbarui.');
    }

    public function edit($id)
    {
        $hapalan = Hapalan::findOrFail($id);
        $santris = Santri::where('status', '!=', 'calon')->get();
        $gurus = Guru::all();
        $levelHapalan = LevelHapalan::all();
        return view('hapalan.hapalanedit', compact('hapalan', 'santris', 'gurus', 'levelHapalan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_santri' => 'required|exists:santris,id_santri',
            'id_guru' => 'required|exists:gurus,id_guru',
            'juz' => 'required|integer|min:1|max:20',
            'id_level_hapalan' => 'required|exists:level_hapalans,id_level_hapalan',
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
        if (Auth::user()->hasRole('guru')) {
            $guru = Auth::user()->guru;
        }
        return view('hapalan.hapalanDetail', compact('hapalan'));
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

        return redirect()->route('hapalan.showDetail', $id)->with('success', 'Detail hapalan berhasil ditambahkan.');
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

        return redirect()->route('hapalan.showDetail', $detail->id_hapalan)->with('success', 'Detail hapalan berhasil diperbarui.');
    }

    public function destroyDetail($id)
    {
        $detail = HapalanDetail::findOrFail($id);
        $id_hapalan = $detail->id_hapalan;
        $detail->delete();

        return redirect()->route('hapalan.showDetail', $id_hapalan)->with('success', 'Detail hapalan berhasil dihapus.');
    }


    public function showKitab($id)
    {
        $hapalan = Hapalan::with(['santri', 'guru', 'kitab'])->findOrFail($id);
        return view('hapalan.hapalanKitab', compact('hapalan'));
    }

    public function storeKitab(Request $request, $id)
    {
        $hapalan = Hapalan::findOrFail($id);

        $request->validate([
            'keterangan_1' => 'required|string',
            'keterangan_2' => 'nullable|string',
            'keterangan_3' => 'nullable|string',
            'keterangan_4' => 'nullable|string',
            'waktu' => 'required|date',
        ]);

        HapalanKitab::create([
            'id_hapalan' => $id,
            'id_santri' => $hapalan->id_santri,
            'id_guru' => $hapalan->id_guru,
            'keterangan_1' => $request->keterangan_1,
            'keterangan_2' => $request->keterangan_2,
            'keterangan_3' => $request->keterangan_3,
            'keterangan_4' => $request->keterangan_4,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('hapalan.kitab.show', $id)
                        ->with('success', 'Hapalan kitab berhasil ditambahkan.');
    }

    public function editKitab($id)
    {
        $kitab = HapalanKitab::findOrFail($id);
        return view('hapalan.hapalankitabedit', compact('kitab'));
    }

    public function updateKitab(Request $request, $id)
    {
        $request->validate([
            'keterangan_1' => 'required|string',
            'keterangan_2' => 'nullable|string',
            'keterangan_3' => 'nullable|string',
            'keterangan_4' => 'nullable|string',
            'waktu' => 'required|date',
        ]);

        $kitab = HapalanKitab::findOrFail($id);
        $kitab->update($request->only('keterangan_1', 'keterangan_2', 'keterangan_3', 'keterangan_4', 'waktu'));

        return redirect()->route('hapalan.kitab.show', $kitab->id_hapalan)
                        ->with('success', 'Hapalan kitab berhasil diperbarui.');
    }

    public function destroyKitab($id)
    {
        $kitab = HapalanKitab::findOrFail($id);
        $id_hapalan = $kitab->id_hapalan;
        $kitab->delete();

        return redirect()->route('hapalan.kitab.show', $id_hapalan)
                        ->with('success', 'Hapalan kitab berhasil dihapus.');
    }
}
