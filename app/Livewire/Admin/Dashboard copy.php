<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $userCount;
    public $requestCount;
    public $visitorCount;

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->userCount = User::count();
        $this->requestCount = Request::count();
        // Assuming you have a model or method for visitor tracking
    //    $this->visitorCount = DB::table('visitors')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
