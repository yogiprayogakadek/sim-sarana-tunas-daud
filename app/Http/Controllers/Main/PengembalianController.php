<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengembalianRequest;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Sarana;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('main.pengembalian.index');
    }

    public function render()
    {
        $peminjaman = Peminjaman::all();
        $view = [
            'data' => view('main.pengembalian.render', compact('peminjaman'))->render()
        ];

        return response()->json($view);
    }

    public function validasi(PengembalianRequest $request)
    {
        try {
            $data = [
                'peminjaman_id' => $request->peminjaman_id,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'status' => 'Sudah Dikembalikan',
            ];

            $peminjaman = Peminjaman::find($request->peminjaman_id);
            $pengembalian = Pengembalian::where('peminjaman_id', $request->peminjaman_id)->first();
            // dd($request->all());
            if($pengembalian == null) {
                // if($pengembalian->status != '') {
                    // update ++ stok
                    foreach (json_decode($peminjaman->sarana, true) as $key => $value) {
                        $sarana = Sarana::find($value['saranaId']);
                        $sarana->update([
                            'jumlah' => $sarana->jumlah + (int)$value['jumlah']
                        ]);
                    }
                // }
                Pengembalian::create($data);
            } else {
                $pengembalian->update($data);
            }


            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
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

    public function detailPeminjaman($id)
    {
        $pengembalian = Pengembalian::where('peminjaman_id', $id)->first();
        if(!$pengembalian) {
            $peminjaman = Peminjaman::find($id);
            $sarana = json_decode($peminjaman->sarana, true);
        } else {
            $peminjaman = $pengembalian->peminjaman;
            $sarana = json_decode($peminjaman->sarana, true);
        }

        $data = [
            'tanggal' => $pengembalian->tanggal ?? '',
            'keterangan' => $pengembalian->keterangan ?? '',
            'sarana' => $sarana
        ];

        return response()->json($data);
    }

    public function print(Request $request)
    {
        $kategori = $request->kategori;
        $startTime = $request->input('tanggal_awal');
        $endTime = $request->input('tanggal_akhir');
        if ( $kategori== 'Semua') {
            $pengembalian = Pengembalian::all();
        } else {
            $pengembalian = Pengembalian::whereBetween('tanggal', [$startTime, $endTime])->get();
        }

        $view = [
            'data' => view('main.pengembalian.print.render', compact('pengembalian', 'kategori', 'startTime', 'endTime'))->render(),
        ];

        return response()->json($view);
    }
}
