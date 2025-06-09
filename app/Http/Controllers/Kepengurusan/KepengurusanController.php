<?php

namespace App\Http\Controllers\Kepengurusan;

use App\Models\Kepengurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KepengurusanController extends Controller
{
    public function index(Request $request)
{
    $query = Kepengurusan::query();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('nama', 'like', "%{$search}%");
    }

    $kepengurusan = $query->paginate(10)->withQueryString();

    return view('Kepengurusan.Kepengurusan', compact('kepengurusan'));
}

    public function create()
    {
        return view('Kepengurusan.KepengurusanCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'mulai' => 'required|date',
            'akhir' => 'required|date|after_or_equal:mulai',
        ]);

        DB::beginTransaction();

        try {
            Kepengurusan::create([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'mulai' => $request->mulai,
                'akhir' => $request->akhir,
            ]);

            DB::commit();
            return redirect()->route('kepengurusan.index')->with('success', 'Data kepengurusan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $kepengurusan = Kepengurusan::findOrFail($id);
        return view('Kepengurusan.KepengurusanEdit', compact('kepengurusan'));
    }

    public function update(Request $request, $id)
    {
        $kepengurusan = Kepengurusan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'mulai' => 'required|date',
            'akhir' => 'required|date|after_or_equal:mulai',
        ]);

        DB::beginTransaction();

        try {
            $kepengurusan->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'mulai' => $request->mulai,
                'akhir' => $request->akhir,
            ]);

            DB::commit();
            return redirect()->route('kepengurusan.index')->with('success', 'Data kepengurusan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $kepengurusan = Kepengurusan::findOrFail($id);

        DB::beginTransaction();

        try {
            $kepengurusan->delete();
            DB::commit();
            return redirect()->route('kepengurusan.index')->with('success', 'Data kepengurusan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    // menampilkan detail kepengurusan
    public function showDetail($id)
    {
        $kepengurusan = Kepengurusan::findOrFail($id);

        return response()->json([
            'nama'     => $kepengurusan->nama,
            'jabatan'  => $kepengurusan->jabatan,
            'mulai'    => $kepengurusan->mulai,
            'akhir'    => $kepengurusan->akhir,
        ]);
    }
}