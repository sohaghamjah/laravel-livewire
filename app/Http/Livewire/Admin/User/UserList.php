<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        return view('livewire.admin.user.user-list');
    }

    public function addNewUser(){
        $this->dispatchBrowserEvent('show-user-form');
    }
}
