<?php

namespace App\Http\Controllers\Santri;

use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    
    public function index(Request $request)
    {
        $query = Santri::with(['user', 'kelas', 'tahunAjaran']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
    			$q->where('nama_lengkap', 'like', "%$search%")
      				->orWhereHas('kelas', function ($kelasQuery) use ($search) {
          				$kelasQuery->where('nama_kelas', 'like', "%$search%");
      				})
      				->orWhereHas('tahunAjaran', function ($taQuery) use ($search) {
          			$taQuery->where('tahun_ajaran', 'like', "%$search%");
      				})
     				 ->orWhere('status', 'like', "%$search%");
			});
        }

        $santri = $query->paginate(10)->withQueryString();
        return view('Santri.Santri', compact('santri'));
    }

    public function create()
    {
        $kelas = Kelas::all();
		$tahunAjaran = TahunAjaran::all();
        return view('Santri.SantriCreate', compact('kelas', 'tahunAjaran'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'nama_lengkap' => 'required',
            'nama_panggil' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            // 'email' => 'required|email|unique:santris,email',
            'jenis_kelamin' => 'required',
            'pendidikan_asal' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'no_hp_ayah' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_ibu' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'status' => 'required|in:calon,santri',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'id_jenis_user' => 4, // Santri
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('santri');

            Santri::create([
                'id_user' => $user->id_user,
                'id_kelas' => $request->id_kelas,
				'id_tahun_ajaran' => $request->id_tahun_ajaran, // default kelas atau isi dari inputan kalau ada
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggil' => $request->nama_panggil,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status' => $request->status,
                'pendidikan_asal' => $request->pendidikan_asal,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
            ]);

            DB::commit();
            return redirect()->route('santri.index')->with('success', 'Santri berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menambahkan santri: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $santri = Santri::with('user')->findOrFail($id);
        $kelas = Kelas::all();
		$tahunAjaran = TahunAjaran::all();
        return view('Santri.SantriEdit', compact('santri', 'kelas', 'tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $santri = Santri::with('user')->findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $santri->user->id_user . ',id_user',
            'password' => 'nullable|confirmed|min:6',
            'nama_lengkap' => 'required',
            'nama_panggil' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telepon' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'email' => 'nullable|email|unique:santris,email,' . $id . ',id_santri',
            'jenis_kelamin' => 'required',
            'pendidikan_asal' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'no_hp_ayah' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'no_hp_ibu' => 'required|string|max:14|regex:/^08\d{8,13}$/',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'status' => 'required|in:calon,santri',
        ]);

        DB::beginTransaction();

        try {
            $santri->user->update([
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : $santri->user->password,
            ]);
            

            $santri->update([
                'id_kelas' => $request->id_kelas,
				'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggil' => $request->nama_panggil,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                // 'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status' => $request->status,
                'pendidikan_asal' => $request->pendidikan_asal,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,

            ]);

            DB::commit();
            return redirect()->route('santri.index')->with('success', 'Santri berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal update santri: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $santri = Santri::findOrFail($id);
            $santri->user()->delete(); // otomatis delete santri karena foreign key cascade
            return redirect()->route('santri.index')->with('success', 'Santri berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus santri: ' . $e->getMessage()]);
        }
    }

// menampilkan detail santri
    public function showDetail($id)
    {
        $santri = Santri::with('kelas', 'tahunAjaran')->findOrFail($id);

        return response()->json([
            'nama_lengkap'     => $santri->nama_lengkap,
            'email'            => $santri->email,
            'no_telepon'       => $santri->no_telepon,
            'jenis_kelamin'    => $santri->jenis_kelamin,
            'status'           => ucfirst($santri->status),
            'alamat'           => $santri->alamat,
            'tanggal_lahir'    => $santri->tanggal_lahir,
            'nama_panggil'     => $santri->nama_panggil,
            'pendidikan_asal'  => $santri->pendidikan_asal,
            'nama_ayah'        => $santri->nama_ayah,
            'pekerjaan_ayah'   => $santri->pekerjaan_ayah,
            'no_hp_ayah'       => $santri->no_hp_ayah,
            'nama_ibu'         => $santri->nama_ibu,
            'pekerjaan_ibu'    => $santri->pekerjaan_ibu,
            'no_hp_ibu'        => $santri->no_hp_ibu,
            'kelas'            => $santri->kelas->nama_kelas ?? '-',
			'tahun_ajaran'     => $santri->tahunAjaran->tahun_ajaran ?? '-',
        ]);
    }
}
