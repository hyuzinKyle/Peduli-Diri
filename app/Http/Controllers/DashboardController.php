<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;

class DashboardController extends Controller
{
    public function indexSiswa(Request $request)
    {
        // $data_siswa = Siswa::orderBy('id')->get();
        $keyword = $request->search;
        // $data_siswa = Siswa::where('nama', 'like', "%" . $keyword . "%")->get();
        $data_siswa = Siswa::where('nama', 'like', "%" . $keyword . "%")
            ->orWhere(function ($query) use ($keyword) {
                $query->where('id', 'like', "%" . $keyword . "%");
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('nik', 'like', "%" . $keyword . "%");
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('agama', 'like', "%" . $keyword . "%");
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('jenis_kelamin', 'like', "%" . $keyword . "%");
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('umur', 'like', "%" . $keyword . "%");
            })->get();

        return view('pages.card', [
            'data_siswa' => $data_siswa
        ]);
    }

    public function indexPerjalanan()
    {
        // $data_perjalanan = Perjalanan::all();
        // return view('pages.dashboard', ['data_perjalanan' => $data_perjalanan]);
        if(auth()->user()) {
            $data_perjalanan = DB::table('perjalanans')
            ->join('users', 'users.id', '=', 'perjalanans.user_id')
            ->select('users.nik', 'perjalanans.id', 'perjalanans.tanggal','perjalanans.lokasi', 'perjalanans.waktu', 'perjalanans.suhu')
            ->where('users.id', '=', auth()->user()->id)
            ->paginate(10);

            return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
        }

        return view('pages.perjalanan');
    }
}
