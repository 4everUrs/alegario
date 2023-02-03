<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $name, $phone, $email, $username;
    public $old_password, $new_password, $confirm_password;
    public function render()
    {
        return view('livewire.profile');
    }
    public function save()
    {
        User::find(Auth::user()->id)->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'username' => $this->username,
        ]);
        toastr()->addSuccess('Profile Update Successfully');
        return redirect()->route('account');
    }
    public function changePassword()
    {
        $user = User::find(auth()->user()->id);
        $data = $this->validate([
            'old_password'     => 'required|current_password',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user->password = Hash::make($this->new_password);
        $user->save();
        toastr()->addSuccess('Password Update Successfully');
        return redirect()->route('account');
        $this->reset();
    }
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->username = $user->username;
    }
}
