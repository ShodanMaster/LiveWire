<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public function render()
    {
        $users = User::where("name", "LIKE", "%" . $this->search ."%")
                        ->orWhere("email", "LIKE", "%" . $this->search ."%")
                        ->paginate(10);
        return view('livewire.users', compact('users'));
    }
}
