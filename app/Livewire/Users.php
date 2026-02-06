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

    // public $users = [];
    #[Url]
    public $search;

    public function render()
    {
        sleep(3);
        $users = User::where("name", "LIKE", "%" . $this->search . "%")
            ->orWhere("email", "LIKE", "%" . $this->search . "%")
            ->paginate(10);
        return view('livewire.users', compact('users'));
    }

    public function placeholder(){
        return <<<'HTML'
            <div class="text-cetner">
                <img src="https://imgs.search.brave.com/OZJnCTXNV6lh_igSlIBKAxPL51UbDjOjWEDabxdtpqI/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9tZWRp/YS50ZW5vci5jb20v/ZXFyODdGSDIxWGtB/QUFBbS9sb2FkaW5n/LndlYnA" width="150px">
            </div>
        HTML;
    }

    public function delete($id){
        User::find($id)->delete();
    }

    // public function loadUsers(){
    //     $this->users = User::limit(10)->get();
    // }

}
