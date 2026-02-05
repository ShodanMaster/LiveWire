<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $users = [];
    #[Url]
    public $search;

    public function render()
    {
        // $users = User::where("name", "LIKE", "%" . $this->search ."%")
        //                 ->orWhere("email", "LIKE", "%" . $this->search ."%")
        //                 ->paginate(10);
        return view('livewire.users',
        // compact('users')
        );
    }

    public function delete($id){
        User::find($id)->delete();
    }

    public function loadUsers(){
        $this->users = User::limit(10)->get();
    }
}
