<?php

namespace App\Http\Controllers;

use App\Events\PasswordChanged;
use App\Http\Controllers\Controller;
use App\Rules\CurrentPassword;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show change password form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.profile.change-password', [
            'user' => $this->getCurrentUser(),
        ]);
    }

    /**
     * Update password
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $this->getCurrentUser();

        $this->validate($request, [
            'current_password' => ['required', new CurrentPassword($user)],
            'password' => 'required|confirmed|min:8',
        ]);

        $this->changePassword($user, $request->input('password'));

        return redirect()->route('password.change')->with('status', __('Your password updated.'));
    }

    /**
     * Get current logged in user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function getCurrentUser(): ?Authenticatable
    {
        return $this->guard()->user();
    }

    /**
     * Change the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string  $password
     * @return void
     */
    protected function changePassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordChanged($user));

        $this->guard()->login($user);
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
