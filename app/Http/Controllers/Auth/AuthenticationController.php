<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    /**
     * Show the registration page.
     *
     * @return \Inertia\Response
     */
    public function createRegister(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeRegister(RegisterRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $user = User::create([
                'name'              => $data['name'],
                'email'             => $data['email'],
                'password'          => Hash::make($data['password']),
                'phone_number'      => $data['phone_number'],
            ]);

            Auth::login($user);

            DB::commit();

            return redirect()->route('dashboard.index');
        } catch (\Illuminate\Validation\ValidationException $e) {

            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

    }

    /**
     * Display the login view.
     */
    public function createLogin(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function storeLogin(LoginRequest $request): RedirectResponse
    {
        try {
            // Check if the user is already authenticated first
            if (Auth::check()) {
                return redirect()->route('index')->with('success', 'You are already logged in');
            }

            $data = $request->validated();

            // Determine login method (email or phone)
            if (!empty($data['phone_number'])) {
                $credentials = [
                    'phone_number' => $data['phone_number'],
                    'password' => $data['password'],
                ];
            } else {
                $credentials = [
                    'email'         => $data['email'],
                    'password'      => $data['password'],
                ];
            }

            // Attempt to authenticate
            if (Auth::attempt($credentials, $request->boolean('remember', false))) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('success', 'Login successful');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
