<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserList extends Component
{
    public $state = [];
    public $show_edit_user_modal = false;
    public $user;

    public function addNewUser(){
        $this->show_edit_user_modal = false;
        $this->dispatchBrowserEvent('show-user-form');
    }

    public function userStore(){
        $validated =  Validator::make($this->state, [
            'email'    => 'email|required|unique:users,email',
            'name'     => 'string|required|max:100',
            'password' => 'required|confirmed|min:6',
        ])->validate();

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        $this->dispatchBrowserEvent('hide-user-form', ['message' => 'User Created Successful!']);
    }

    public function editUser(User $user){
        $this->show_edit_user_modal = true;
        $this->user = $user;
        $this->state = $user->toArray();

        $this->dispatchBrowserEvent('show-user-form');
    }

    public function userUpdate(){
        $validated =  Validator::make($this->state, [
            'email'    => 'email|required|unique:users,email,'.$this->user->id,
            'name'     => 'string|required|max:100',
            'password' => 'sometimes|confirmed|min:6',
        ])->validate();

        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }

        $this->user->update($validated);

        $this->dispatchBrowserEvent('hide-user-form', ['message' => 'User Updated Successful!']);
    }

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.user.user-list', [
            'users' => $users,
        ]);
    }
}
