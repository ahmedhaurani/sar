<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Request;
use App\Models\Visitor; // Import the Visitor model
use Carbon\Carbon;

class Dashboard extends Component
{
    public $userCount;
    public $requestCount;
    public $visitorCount;
    public $onlineUsersCount;
    public $requestPendingCount;
    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->userCount = User::count();
        $this->requestCount = Request::count();
        $this->requestPendingCount = Request::where('status', 'pending')->count();

        // Time thresholds
        $last24Hours = Carbon::now()->subHours(24);
        $last5Minutes = Carbon::now()->subMinutes(5);

        // Count visitors in the last 24 hours using the Visitor model
        $this->visitorCount = Visitor::where('last_activity', '>=', $last24Hours)->count();

        // Count online users (last 5 minutes)
        $this->onlineUsersCount = Visitor::where('last_activity', '>=', $last5Minutes)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
