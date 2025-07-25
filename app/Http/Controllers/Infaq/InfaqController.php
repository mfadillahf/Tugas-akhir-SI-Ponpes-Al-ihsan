<?php

namespace App\Http\Controllers\Infaq;

use App\Models\Infaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Donatur;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Illuminate\Support\Facades\Storage;

class InfaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:donatur')->only(['create', 'store', 'pay']);
        $this->middleware('role:admin|donatur')->only(['index', 'show']);

        // Midtrans Configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $infaqs = Infaq::with('donatur')->latest()->get();
        } else {
            $donatur = $user->donatur;

            if (!$donatur) {
                return back()->with('error', 'Akun ini belum terhubung dengan data donatur.');
            }

            $infaqs = Infaq::with('donatur')
                ->where('id_donatur', $donatur->id_donatur)
                ->latest()
                ->get();
        }

        return view('infaq.infaq', compact('infaqs'));
    }

    public function create()
    {
        return view('infaq.infaqCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        $donatur = Auth::user()->donatur;

        if (!$donatur) {
            return back()->with('error', 'Akun ini belum terhubung dengan data donatur.');
        }

        try {
            $data = [
                'id_donatur' => $donatur->id_donatur,
                'nominal' => $request->nominal,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,

                'status' => 'pending',
            ];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/infaq', $filename);
                $data['foto'] = $filename;
            }

            Infaq::create($data);

            DB::commit();
            return redirect()->route('infaq.index')->with('success', 'Data Infaq berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
	
	public function updateNominal(Request $request, $id)
		{
			$request->validate([
				'nominal' => 'required|integer',
			]);

			$infaq = Infaq::findOrFail($id);

			if ($infaq->status !== 'pending') {
				return back()->with('error', 'Hanya infaq dengan status pending yang bisa diubah nominalnya.');
			}

			try {
				$infaq->nominal = $request->nominal;
				$infaq->save();

				return redirect()->route('infaq.index')->with('success', 'Nominal infaq berhasil diperbarui.');
			} catch (\Exception $e) {
				return back()->withErrors(['error' => 'Gagal memperbarui nominal: ' . $e->getMessage()]);
			}
		}

    public function pay(Request $request)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:1000',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $donatur = $user->donatur;

        if (!$donatur) {
            return back()->with('error', 'Data donatur tidak ditemukan.');
        }

        $infaq = Infaq::create([
            'id_donatur' => $donatur->id_donatur,
            'nominal' => $validated['nominal'],
            'tanggal' => $validated['tanggal'],
            'keterangan' => $validated['keterangan'] ?? 'Sedang diproses',
            'status' => 'pending',
        ]);

        $orderId = 'INFAQ-' . $infaq->id_infaq . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $infaq->nominal,
            ],
            'customer_details' => [
                'first_name' => $donatur->nama,
                'email' => $donatur->email,
                'phone' => $donatur->no_telepon,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membuat transaksi pembayaran: ' . $e->getMessage());
        }

        return view('infaq.pay', compact('snapToken', 'infaq'));
    }

    public function callback(Request $request)
    {
        $json = json_decode($request->getContent());

        if (!isset($json->order_id, $json->transaction_status, $json->signature_key, $json->gross_amount, $json->status_code)) {
            return response()->json(['message' => 'Data callback tidak lengkap'], 400);
        }

        // Validasi signature key
        $expectedSignature = hash(
            'sha512',
            $json->order_id .
                $json->status_code .
                $json->gross_amount .
                config('services.midtrans.server_key')
        );

        if ($json->signature_key !== $expectedSignature) {
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        // Parsing ID infaq dari order_id
        preg_match('/INFAQ-(\d+)-/', $json->order_id, $matches);
        $infaqId = $matches[1] ?? null;

        if (!$infaqId) {
            return response()->json(['message' => 'Format order ID tidak valid'], 400);
        }

        $infaq = Infaq::find($infaqId);

        if (!$infaq) {
            return response()->json(['message' => 'Data infaq tidak ditemukan'], 404);
        }

        switch ($json->transaction_status) {
            case 'settlement':
                $infaq->status = 'paid';
                $infaq->keterangan = 'Pembayaran berhasil';
                break;

            case 'pending':
                $infaq->status = 'pending';
                $infaq->keterangan = 'Menunggu pembayaran';
                break;

            case 'deny':
            case 'expire':
            case 'cancel':
                $infaq->status = 'failed';
                $infaq->keterangan = 'Pembayaran gagal atau dibatalkan';
                break;

            default:
                return response()->json(['message' => 'Status tidak ditangani'], 200);
        }

        $infaq->save();

        return response()->json(['message' => 'Callback diproses'], 200);
    }

    public function terima($id)
    {
        $infaq = Infaq::findOrFail($id);
        $infaq->status = 'paid';
        $infaq->save();

        return back()->with('success', 'Status infaq berhasil diubah menjadi Diterima.');
    }

    public function tolak($id)
    {
        $infaq = Infaq::findOrFail($id);
        $infaq->status = 'failed';
        $infaq->save();

        return back()->with('success', 'Status infaq berhasil diubah menjadi Ditolak.');
    }
	
	public function destroy($id)
    {
        $infaq = Infaq::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($infaq->foto && Storage::exists('public/infaq/' . $infaq->foto)) {
                Storage::delete('public/infaq/' . $infaq->foto);
            }

            $infaq->delete();

            DB::commit();
            return redirect()->route('infaq.index')->with('success', 'Infaq berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
