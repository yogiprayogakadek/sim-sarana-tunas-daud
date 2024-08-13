<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaranaRequest;
use App\Models\Sarana;
use Illuminate\Http\Request;

class SaranaController extends Controller
{
    public function index()
    {
        return view('main.sarana.index');
    }

    public function render()
    {
        $sarana = Sarana::all();
        $view = [
            'data' => view('main.sarana.render', compact('sarana'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $kategori = [
            'Lab Komputer', 'Ruang Admin', 'Ruang Kelas'
        ];
        $view = [
            'data' => view('main.sarana.create', compact('kategori'))->render()
        ];

        return response()->json($view);
    }

    public function store(SaranaRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'kepemilikan' => $request->kepemilikan,
            ];

            if($request->hasFile('foto')) {
                $fileExtension = $request->file('foto')->getClientOriginalExtension();
                $fileNameStore = str_replace(' ', '-', $request->nama) . '.' . $fileExtension;
                $savePath = 'assets/uploads/sarana/';

                if(!file_exists(public_path($savePath))) {
                    mkdir(public_path($savePath), 0775, true);
                }

                $request->file('foto')->move(public_path($savePath), $fileNameStore);

                $data['foto'] = $savePath . '/' . $fileNameStore;
            }

            Sarana::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $kategori = [
            'Lab Komputer', 'Ruang Admin', 'Ruang Kelas'
        ];
        $sarana = Sarana::find($id);
        $view = [
            'data' => view('main.sarana.edit', compact('kategori', 'sarana'))->render()
        ];

        return response()->json($view);
    }

    public function update(SaranaRequest $request)
    {
        try {
            $sarana = Sarana::find($request->id);
            $data = [
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'kepemilikan' => $request->kepemilikan,
            ];

            if($request->hasFile('foto')) {
                $fileExtension = $request->file('foto')->getClientOriginalExtension();
                $fileNameStore = str_replace(' ', '-', $request->nama) . '.' . $fileExtension;
                $savePath = 'assets/uploads/sarana/';

                if(!file_exists(public_path($savePath))) {
                    mkdir(public_path($savePath), 0775, true);
                }

                $request->file('foto')->move(public_path($savePath), $fileNameStore);

                $data['foto'] = $savePath . '/' . $fileNameStore;
            }

            $sarana->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete(Request $request)
    {
        try{
            $sarana = Sarana::find($request->id);

            $sarana->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil terhapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan!',
                'title' => 'Gagal'
            ]);
        }
    }
}
