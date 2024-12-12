<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function loginProcess(Request $request)
    {
        $request->validate([
            'namaUser' => 'required',
            'passwordUser' => 'required|min:6',
        ]);

        $nama = $request->input('namaUser');
        $password = $request->input('passwordUser');

        // Login Pelanggan
        $user = User::where('namaUser', $nama)->first();
        if ($user && Hash::check($password, $user->passwordUser)) {
            Auth::guard('users')->login($user);
            // session()->flash('login_message', 'Selamat datang di Tanam.in!');
            return redirect()->route('home');
        }

        // // Login Karyawan
        // $karyawan = karyawanModel::where('usernameKywn', $username)->first();
        // if ($karyawan && $karyawan->passwordKywn === $password) {
        //     Auth::guard('karyawan')->login($karyawan);
        //     // session()->flash('login_message', 'Selamat datang di Tanam.in!');
        //     return redirect()->route('homeKywn');
        // }

        // Jika tidak ditemukan
        return redirect()->route('login')->with('error_message', 'Nama atau password salah.');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function registerProcess(Request $request)
    {
        // Validasi input
        $cradential = $request->validate([
            'namaUser' => 'required',
            'emailUser' => 'required|email|unique:users,emailUser',
            'notelpUser' => 'required',
            'passwordUser' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
            'passwordUser_confirmation' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
        ], [
            'passwordUser.required' => 'Password wajib diisi.',
            'passwordUser.min' => 'Password harus memiliki minimal 6 karakter.',
            'passwordUser.regex' => 'Password harus mengandung setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 simbol khusus.',
        ]);

        if (User::where('emailUser', $request->emailUser)->exists() || User::where('namaUser', $request->namaUser)->exists()) {
            // return response()->json(["error" => "Email or telepon already exists"], 400);
            return redirect()->route('auth.register')->with('error', 'Email atau Nama sudah terpakai!');
        } else if ($request->passwordUser == $request->passwordUser_confirmation) {
            // Proses pendaftaran
            $user = new User();
            $user->namaUser = $request->input('namaUser');
            $user->notelpUser = $request->input('notelpUser');
            $user->emailUser = $request->input('emailUser');
            $user->passwordUser = Hash::make($request->input('passwordUser'));

            $user->save();

            Auth::guard('users')->login($user);
            // session()->flash('msg', 'Registrasi berhasil. Silakan login.');
            // return redirect()->route('login.login');
            return redirect()->route('login')->with('msg', 'Registrasi berhasil! Anda dapat login.');
        } else {
            return redirect()->back()->withErrors($cradential)->withInput();
        }
    }
}