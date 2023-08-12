<?php

namespace App\Http\Livewire\Admin\User;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UserList extends Component
{
    public $state = [];
    public function userStore(){
        Validator::make($this->state, [
            'email'    => 'email|required|unique:users,email',
            'name'     => 'string|required|max:100',
            'password' => 'required|confirmed|min:6',
        ])->validate();

        dd('ok');
    }

    public function render()
    {
        return view('livewire.admin.user.user-list');
    }

    public function addNewUser(){
        $this->dispatchBrowserEvent('show-user-form');
    }
}
