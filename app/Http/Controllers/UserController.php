<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function viewlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(Auth::attempt(['username' => $username, 'password' =>$password] )){

            $request->session()->regenerate();

            return redirect()->route('viewDashboard');
        }else{

            return back();
        }

    }

    public function viewregister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = "{$request->namadepan} {$request->namabelakang}";
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->nama_perusahaan = $request->nama_perusahaan;
        $user->alamat_perusahaan = $request->alamat;
        $user->kota_kabupaten = $request->kota;
        $user->no_tlp = $request->no_tlp;
        $user->npwp = $request->npwp;
        $user->nomor_siup_tdp = $request->no_siup_tdp;
        $user->nama_direktur = $request->nama_direktur;
        $user->nama_estimator = $request->nama_estimator;
        $user->save();


        return redirect()->route('viewlogin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('viewlogin');
    }

    public function viewUser()
    {
        return view('viewUser');
    }

    public function changePassword(Request $request)
    {
        if($request->password == $request->retypepassword){
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = bcrypt($request->password);
            $user->update();
            return redirect()->back();
        }else{
            return redirect()->back()->with('alert', 'password tidak sama');
        }

        
    }

}
