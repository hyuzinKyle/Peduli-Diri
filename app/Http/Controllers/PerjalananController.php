<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;


class PerjalananController extends Controller
{

    public function index()
    {
        return view('pages.form_perjalanan');
    }

    public function create(Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'suhu' => $request->suhu,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi
        ];

        Perjalanan::create($data);

        return redirect('/perjalanan')->with('message', 'Data berhasil ditambahkan');
    }

    public function delete($id) {
        $perjalanan = Perjalanan::find($id);
        $perjalanan->delete($perjalanan);

        return redirect('/perjalanan')->with('message', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $perjalanan = Perjalanan::find($id);

        if(!$perjalanan) {
            return abort(404);
        }

        if (auth()->user()->id = $perjalanan->user_id){
            return view('pages.edit_perjalanan', ['perjalanan' => $perjalanan]);
        }

        return abort(404);

    }

    public function update(Request $request, $id)
    {
        $perjalanan = Perjalanan::find($id);
        $data = $request->all();

        $perjalanan->update($data);

        return redirect('/perjalanan')->with('message', 'Data berhasil di ubah');
    }

    public function cariPerjalanan(Request $request) {
        //lokasi
        if(!empty($request->input('lokasi'))&& empty($request->input('tanggal'))&& empty($request->input('waktu'))&& empty($request->input('suhu')) ){
            $cari=$request->lokasi;
            $data_perjalanan = User::join('perjalanans', 'perjalanans.user_id', '=', 'users.id')
                ->where(function ($query) use ($cari) {
                    $query->where('users.nama', auth()->user()->nama)
                        ->where('perjalanans.lokasi', 'LIKE', '%'. $cari . '%');
                })->orderBy('tanggal')->paginate(10,['users.nama', 'perjalanans.*']);
                if($data_perjalanan) {
                    return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
                }else{
                    abort(404);
                }
        //cari tanggal
        }elseif(empty($request->input('lokasi'))&& !empty($request->input('tanggal'))&& empty($request->input('waktu'))&& empty($request->input('suhu')) ){
            $cari=$request->tanggal;
            $data_perjalanan = User::join('perjalanans', 'perjalanans.user_id', '=', 'users.id')
                ->where(function ($query) use ($cari) {
                    $query->where('users.nama', auth()->user()->nama)
                        ->where('perjalanans.tanggal', 'LIKE', '%'. $cari . '%');
                })->orderBy('waktu')->paginate(10,['users.nama', 'perjalanans.*']);
                if($data_perjalanan) {
                    return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
                }else{
                    abort(404);
                }
        //cari waktu
        }elseif(empty($request->input('lokasi'))&& empty($request->input('tanggal'))&& !empty($request->input('waktu'))&& empty($request->input('suhu')) ){
            $cari=$request->waktu;
            $data_perjalanan = User::join('perjalanans', 'perjalanans.user_id', '=', 'users.id')
                ->where(function ($query) use ($cari) {
                    $query->where('users.nama', auth()->user()->nama)
                        ->where('perjalanans.waktu', 'LIKE', '%'. $cari . '%');
                })->orderBy('tanggal')->paginate(10,['users.nama', 'perjalanans.*']);
                if($data_perjalanan) {
                    return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
                }else{
                    abort(404);
                }
        //cari suhu
        }elseif(empty($request->input('lokasi'))&& empty($request->input('tanggal'))&& empty($request->input('waktu'))&& !empty($request->input('suhu')) ){
            $cari=$request->suhu;
            $data_perjalanan = User::join('perjalanans', 'perjalanans.user_id', '=', 'users.id')
                ->where(function ($query) use ($cari) {
                    $query->where('users.nama', auth()->user()->nama)
                        ->where('perjalanans.suhu', 'LIKE', '%'. $cari . '%');
                })->orderBy('tanggal')->paginate(10,['users.nama', 'perjalanans.*']);
                if($data_perjalanan) {
                    return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
                }else{
                    abort(404);
                }
        //else
        }else {
            $data_perjalanan = DB::table('perjalanans')
            ->join('users', 'users.id', '=', 'perjalanans.user_id')
            ->select('users.nik', 'perjalanans.id','perjalanans.tanggal','perjalanans.lokasi', 'perjalanans.waktu', 'perjalanans.suhu')
            ->where('users.id', '=', auth()->user()->id)
            ->paginate(10);

            return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);

        }



    }

    public function sortingPerjalanan(Request $request)
    {
        $orderBy = $request->orderBy;
        $sortBy = $request->sortBy;

        if(auth()->user())
        {
            $data_perjalanan = DB::table('perjalanans')
            ->join('users', 'users.id', '=', 'perjalanans.user_id')
            ->select('users.nik', 'perjalanans.id', 'perjalanans.tanggal','perjalanans.lokasi', 'perjalanans.waktu', 'perjalanans.suhu')
            ->where('users.id', '=', auth()->user()->id)
            ->orderBy('perjalanans.'. $orderBy, $sortBy)
            ->paginate(10);

            return view('pages.perjalanan', ['data_perjalanan' => $data_perjalanan]);
        }

        return view('pages.perjalanan');

    }

}
