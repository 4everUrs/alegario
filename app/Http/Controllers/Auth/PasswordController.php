<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $data = $request->all();

        $user = User::find(auth()->user()->id);

        if (!\Hash::check($data['old_password'], $user->password)) {

            return back()->with('error', 'You have entered wrong password');
        } else {

            $request->user()->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            toastr()->addSuccess('Password Update Successfully');
        }
    }
}
