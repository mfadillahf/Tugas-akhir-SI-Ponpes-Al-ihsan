<?php

namespace App\Http\Controllers\Infaq;

use App\Models\Infaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class InfaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:donatur')->only(['create', 'store']);
        $this->middleware('role:admin|donatur')->only(['index', 'show']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Admin bisa melihat semua infaq
            $infaqs = Infaq::with('donatur')->latest()->get();
        } else {
            // Donatur hanya bisa melihat infaq miliknya sendiri
            $donatur = $user->donatur;
            if (!$donatur) {
                return back()->with('error', 'Akun ini belum terhubung dengan data donatur.');
            }

            $infaqs = Infaq::with('donatur')
                ->where('id_donatur', $donatur->id_donatur)
                ->latest()
                ->get();
        }

        return view('Infaq.Infaq', compact('infaqs'));
    }

    public function create()
    {
        return view('Infaq.InfaqCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nominal' => 'required|integer|min:1000',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:50',
        ]);

        $donatur = Auth::user()->donatur;
        if (!$donatur) {
            return back()->with('error', 'Akun ini belum terhubung dengan data donatur.');
        }

        Infaq::create([
            'id_donatur' => $donatur->id_donatur,
            'nominal' => $validated['nominal'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil disimpan.');
    }

    public function show(Infaq $infaq)
    {
        $user = Auth::user();

        if ($user->hasRole('donatur')) {
            $donatur = $user->donatur;
            if (!$donatur || $infaq->id_donatur !== $donatur->id_donatur) {
                abort(403, 'Anda tidak memiliki izin untuk melihat data ini.');
            }
        }

        return view('infaq.show', compact('infaq'));
    }
}
