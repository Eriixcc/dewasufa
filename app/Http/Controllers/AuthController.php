<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Handle user signup and store credentials and profile photo in database.
     */
    public function signup(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', Password::min(8)],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:2048'],
        ], [
            'name.required' => 'Nama pengguna / username wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk ke akun Anda.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak cocok.',
            'avatar.image' => 'File foto profil harus berupa gambar.',
            'avatar.mimes' => 'Format foto profil harus JPG, PNG, WEBP, atau GIF.',
            'avatar.max' => 'Ukuran foto profil maksimal adalah 2MB.',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('images/avatars');

            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $file->move($targetDir, $fileName);
            $avatarPath = 'images/avatars/'.$fileName;
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('dashboard');

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil didaftarkan! Selamat datang di Dewasufa, '.$user->name.'.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'avatar' => $user->avatar ? asset($user->avatar) : null,
                ],
                'redirect' => $redirectUrl,
            ], 201);
        }

        return redirect()->intended($redirectUrl)->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $loginInput = trim($validated['login']);
        $password = $validated['password'];
        $remember = $request->boolean('remember');

        // Check if login input is email or phone or name
        $user = null;
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', strtolower($loginInput))->first();
        } else {
            // Clean phone characters
            $cleanPhone = preg_replace('/[^0-9+]/', '', $loginInput);
            $user = User::where('phone', $loginInput)
                ->orWhere('phone', $cleanPhone)
                ->orWhere('name', $loginInput)
                ->first();
        }

        if (! $user || ! Hash::check($password, $user->password)) {
            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email/telepon atau kata sandi tidak cocok.',
                ], 422);
            }

            return back()->withErrors(['login' => 'Email/telepon atau kata sandi tidak cocok.'])->withInput();
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();

        $redirectUrl = $user->isAdmin() ? route('admin.dashboard') : route('dashboard');

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Selamat datang kembali, '.$user->name.'!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                    'avatar' => $user->avatar ? asset($user->avatar) : null,
                ],
                'redirect' => $redirectUrl,
            ]);
        }

        return redirect()->intended($redirectUrl)->with('success', 'Berhasil masuk!');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil keluar.',
                'redirect' => route('home'),
            ]);
        }

        return redirect()->route('home')->with('success', 'Berhasil keluar.');
    }
}
