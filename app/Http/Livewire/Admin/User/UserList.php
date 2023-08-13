<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserList extends Component
{
    public function addNewUser(){
        $this->dispatchBrowserEvent('show-user-form');
    }

    public $state = [];
    public function userStore(){
        $validated =  Validator::make($this->state, [
            'email'    => 'email|required|unique:users,email',
            'name'     => 'string|required|max:100',
            'password' => 'required|confirmed|min:6',
        ])->validate();


        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $this->dispatchBrowserEvent('hide-user-form');
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.user.user-list', [
            'users' => $users,
        ]);
    }
}
