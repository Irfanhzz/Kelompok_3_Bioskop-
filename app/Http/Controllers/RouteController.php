<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data tiket berdasarkan ID user yang sedang login
        $bioskop = DB::table('tb_pesan')->where('id_user', $userId)->get();

        return view('index', ['bioskop' => $bioskop]);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function pesan($id)
    {
        $bioskop = DB::table('tb_users')->where('id', $id)->get();
        return view('pesan', ['bioskop' => $bioskop]);
    }

    public function pesanadd(Request $request)
    {
        DB::table('tb_pesan')->insert([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'judul_film' => $request->judul_film,
            'jam' => $request->jam,
            'kursi' => $request->selected_kursi,
        ]);
        return redirect('/');
    }

    /**
     * Menampilkan halaman edit data tiket.
     */
    public function edit($id)
    {
        $tiket = DB::table('tb_pesan')->where('id', decrypt($id))->first();

        // Jika tiket tidak ditemukan, arahkan ke halaman utama dengan pesan error
        if (!$tiket) {
            return redirect('/')->withErrors(['error' => 'Data tiket tidak ditemukan!']);
        }

        return view('edit', ['tiket' => $tiket]);
    }

    /**
     * Memproses pembaruan data tiket.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'judul_film' => 'required|string|max:255',
            'jam' => 'required|string|max:50',
            'kursi' => 'required|string|max:50',
        ]);

        DB::table('tb_pesan')->where('id', decrypt($id))->update([
            'nama' => $request->nama,
            'judul_film' => $request->judul_film,
            'jam' => $request->jam,
            'kursi' => $request->kursi,
        ]);

        return redirect('/')->with('success', 'Data tiket berhasil diperbarui!');
    }
}
