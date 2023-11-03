<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function kelolapengguna()
    {
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        $roles = Role::all();
        $pengguna = User::all();
        return view('ga.kelolapengguna', [
            'karyawan' => $karyawan,
            'pengguna' => $pengguna,
            'roles' => $roles
        ]);
    }

    public function add_user(Request $request)
    {
        $user = new User;
        $user->name = $request->input('namal');
        $user->email = $request->input('nik');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->level = $request->input('level');
        $user->departemen = $request->input('departemen');
        $user->perusahaan = $request->input('perusahaan');
        $user->no_telp = $request->input('no_telp');
        $user->id_role = $request->input('role');
        $user->save();

        Session::flash('success', 'Menu berhasil disimpan.');

        return redirect()->route("ga.kelolapengguna");

    }

    public function update_user(Request $request, $id){
        $role = 'urole' . $id;
        $status = 'status' . $id;
        $pengguna = User::find($id);
        if($request->$role != null){
            $pengguna->update([
                'id_role' => $request->$role
            ]);
        }
        if($request->$status != null){
            $pengguna->update([
                'status' => $request->$status
            ]);
        }

        return redirect()->route("ga.kelolapengguna");
    }
}
