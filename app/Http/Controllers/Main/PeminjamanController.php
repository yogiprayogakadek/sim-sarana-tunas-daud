<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Sarana;
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
        $view = [
            'data' => view('main.peminjaman.create', compact('sarana'))->render()
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'sarana' => json_encode(json_decode($request->list_sarana, true)[0]['data']),
                'tanggal' => $request->tanggal,
                'nama_peminjam' => $request->nama_peminjam,
                'keterangan' => $request->keterangan,
            ];
            // dd(json_encode(json_decode($request->list_sarana, true)[0]['data']));

            foreach (json_decode($request->list_sarana, true)[0]['data'] as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah - (int)$value['jumlah']
                ]);
            }

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
                'nama_peminjam' => $request->nama_peminjam,
                'keterangan' => $request->keterangan,
            ];

            // update ++ stok
            foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah + (int)$value['jumlah']
                ]);
            }

            // update stok
            foreach (json_decode($request->list_sarana, true)[0]['data'] as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah - (int)$value['jumlah']
                ]);
            }

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

        return response()->json($sarana);
    }
}
