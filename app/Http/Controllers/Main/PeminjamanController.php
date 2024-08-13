<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Sarana;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('main.peminjaman.index');
    }

    public function render()
    {
        $peminjaman = Peminjaman::all();
        $view = [
            'data' => view('main.peminjaman.render', compact('peminjaman'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $sarana = Sarana::all();
        $siswa = User::all();
        $view = [
            'data' => view('main.peminjaman.create', compact('sarana', 'siswa'))->render()
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'sarana' => json_encode(json_decode($request->list_sarana, true)[0]['data']),
                'tanggal' => $request->tanggal,
                'user_id' => $request->nama_peminjaman,
                'keterangan' => $request->keterangan,
            ];

            if ($request->hasFile('foto')) {
                $fileExtension = $request->file('foto')->getClientOriginalExtension();
                $fileNameStore = str_replace(' ', '-', $request->nama_peminjaman) . '.' . $fileExtension;
                $savePath = 'assets/uploads/peminjaman';

                if (!file_exists(public_path($savePath))) {
                    mkdir(public_path($savePath), 0775, true);
                }

                $request->file('foto')->move(public_path($savePath), $fileNameStore);

                $data['foto'] = $savePath . '/' . $fileNameStore;
            }

            // foreach (json_decode($request->list_sarana, true)[0]['data'] as $key => $value) {
            //     $sarana = Sarana::find($value['saranaId']);
            //     $sarana->update([
            //         'jumlah' => $sarana->jumlah - (int)$value['jumlah']
            //     ]);
            // }

            Peminjaman::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $sarana = Sarana::all();
        $peminjaman = Peminjaman::find($id);
        $view = [
            'data' => view('main.peminjaman.edit', compact('sarana', 'peminjaman'))->render()
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        try {
            $peminjaman = Peminjaman::find($request->id);
            $data = [
                'sarana' => json_encode(json_decode($request->list_sarana, true)[0]['data']),
                'tanggal' => $request->tanggal,
                'user_id' => $request->nama_peminjam,
                'keterangan' => $request->keterangan,
            ];

            if ($request->hasFile('foto')) {
                $fileExtension = $request->file('foto')->getClientOriginalExtension();
                $fileNameStore = str_replace(' ', '-', $request->nama_peminjam) . '.' . $fileExtension;
                $savePath = 'assets/uploads/peminjaman';

                if (!file_exists(public_path($savePath))) {
                    mkdir(public_path($savePath), 0775, true);
                }

                $request->file('foto')->move(public_path($savePath), $fileNameStore);

                $data['foto'] = $savePath . '/' . $fileNameStore;
            }

            // update ++ stok
            // foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
            //     $sarana = Sarana::find($value['saranaId']);
            //     $sarana->update([
            //         'jumlah' => $sarana->jumlah + (int)$value['jumlah']
            //     ]);
            // }

            // // update stok
            // foreach (json_decode($request->list_sarana, true)[0]['data'] as $key => $value) {
            //     $sarana = Sarana::find($value['saranaId']);
            //     $sarana->update([
            //         'jumlah' => $sarana->jumlah - (int)$value['jumlah']
            //     ]);
            // }

            $peminjaman->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $peminjaman = Peminjaman::find($request->id);
            foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah + (int)$value['jumlah']
                ]);
            }
            $peminjaman->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::find($id);
        $sarana = json_decode($peminjaman->sarana, true);

        return response()->json([
            'sarana' => $sarana,
            'bukti_peminjaman' => $peminjaman->foto
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $peminjaman = Peminjaman::find($request->peminjaman_id);
            $currentStatus = $peminjaman->is_approve;
            $newStatus = $request->status; // Pastikan status baru diterima dari request

            // Periksa perubahan status dan lakukan update stok sesuai logika
            if ($currentStatus === null && $newStatus == 1) {
                // Dari null ke 1: Kurangi stok
                foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                    $sarana = Sarana::find($value['saranaId']);
                    $sarana->update([
                        'jumlah' => $sarana->jumlah - (int)$value['jumlah']
                    ]);
                }
            } elseif ($currentStatus == 1 && $newStatus == 0) {
                // Dari 1 ke 0: Tambah stok
                foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                    $sarana = Sarana::find($value['saranaId']);
                    $sarana->update([
                        'jumlah' => $sarana->jumlah + (int)$value['jumlah']
                    ]);
                }
            } elseif ($currentStatus == 0 && $newStatus == 1) {
                // Dari 0 ke 1: Kurangi stok
                foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                    $sarana = Sarana::find($value['saranaId']);
                    $sarana->update([
                        'jumlah' => $sarana->jumlah - (int)$value['jumlah']
                    ]);
                }
            }

            // Update status peminjaman
            $peminjaman->update(['is_approve' => $newStatus]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil diubah',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function print(Request $request)
    {
        $kategori = $request->kategori;
        $startTime = $request->input('tanggal_awal');
        $endTime = $request->input('tanggal_akhir');
        if ( $kategori== 'Semua') {
            $peminjaman = Peminjaman::all();
        } else {
            $peminjaman = Peminjaman::with('user')->whereBetween('tanggal', [$startTime, $endTime])->get();
        }

        $view = [
            'data' => view('main.peminjaman.print.render', compact('peminjaman', 'kategori', 'startTime', 'endTime'))->render(),
        ];

        return response()->json($view);
    }
}
