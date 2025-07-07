<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user;
        if ($request->tipe == 'peserta') {
            $data = $request->validate([
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'nama' => 'required',
                'telpon' => 'required',
                'tingkatan' => 'required',
                'instansi' => 'required',
                'identitas' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->peserta()->create([
                'nama' => $data['nama'],
                'kode_identitas' => $data['identitas'],
                'no_telepon' => $data['telpon'],
                'tingkatan' => $data['tingkatan'],
                'asal_instansi' => $data['instansi'],
                'profile_picture' => asset('/storage/profile-picture/user.png')
            ]);
        } else if ($request->tipe == 'penyelenggara') {
            $data = $request->validate([
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'nama_penyelenggara' => 'required',
                'nomor_telepon' => 'required',
                'alamat' => 'required',
                'asal_instansi' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->penyelenggara()->create([
                'nama_penyelenggara' => $data['nama_penyelenggara'],
                'alamat' => $data['alamat'],
                'asal_instansi' => $data['asal_instansi'],
                'nomor_telepon' => $data['nomor_telepon'],
                'profile_picture' => asset('/storage/profile-picture/user.png'),
            ]);
        }

        // event(new Registered($user));

        Auth::login($user);

        return to_route('dashboard');
    }
}
