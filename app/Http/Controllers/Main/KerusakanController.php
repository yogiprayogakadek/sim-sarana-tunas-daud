<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kerusakan;
use App\Models\Sarana;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index()
    {
        return view('main.kerusakan.index');
    }

    public function render()
    {
        $kerusakan = Kerusakan::all();
        $view = [
            'data' => view('main.kerusakan.render', compact('kerusakan'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $sarana = Sarana::all();
        $view = [
            'data' => view('main.kerusakan.create', compact('sarana'))->render()
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'sarana' => json_encode(json_decode($request->list_sarana, true)[0]['data']),
                'tanggal' => $request->tanggal,
            ];
            // dd($data);
            // dd(json_encode(json_decode($request->list_sarana, true)[0]['data']));

            foreach (json_decode($request->list_sarana, true)[0]['data'] as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah - (int)$value['jumlah']
                ]);
            }

            Kerusakan::create($data);
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
        $kerusakan = Kerusakan::find($id);
        $view = [
            'data' => view('main.kerusakan.edit', compact('sarana', 'kerusakan'))->render()
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        try {
            $kerusakan = Kerusakan::find($request->id);
            $data = [
                'sarana' => json_encode(json_decode($request->list_sarana, true)[0]['data']),
                'tanggal' => $request->tanggal,
            ];

            // update ++ stok
            foreach (json_decode($kerusakan->sarana, true) as $key => $value) {
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

            $kerusakan->update($data);
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
            $kerusakan = Kerusakan::find($request->id);
            foreach (json_decode($kerusakan->sarana, true) as $key => $value) {
                $sarana = Sarana::find($value['saranaId']);
                $sarana->update([
                    'jumlah' => $sarana->jumlah + (int)$value['jumlah']
                ]);
            }
            $kerusakan->delete();
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
        $kerusakan = Kerusakan::find($id);
        $sarana = json_decode($kerusakan->sarana, true);

        return response()->json($sarana);
    }
}
