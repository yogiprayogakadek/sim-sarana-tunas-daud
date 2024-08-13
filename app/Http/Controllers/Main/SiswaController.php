<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        return view('main.siswa.index');
    }

    public function render()
    {
        $siswa = User::where('role', '!=', 'Admin')->get();
        $view = [
            'data' => view('main.siswa.render', compact('siswa'))->render()
        ];

        return response()->json($view);
    }

    public function edit($id)
    {
        $siswa = User::find($id);
        $view = [
            'data' => view('main.siswa.edit', compact('siswa'))->render()
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        try {
            $siswa = User::find($request->id);

            $siswa->update([
                'nama' => $request->nama,
                'is_active' => $request->is_active
            ]);

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

    public function resetPassword(Request $request)
    {
        try {
            $siswa = User::find($request->id);

            $siswa->update([
                'password' => Hash::make('12345678'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diubah',
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
            $siswa = User::find($request->id);

            $siswa->delete();

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
