<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorsOnline extends Component
{
    public $visitorsCount;
    public $onlineUsersCount;

    public function mount()
    {
        // Time thresholds
        $last24Hours = Carbon::now()->subHours(24);
        $last5Minutes = Carbon::now()->subMinutes(5);

        // Count visitors in the last 24 hours
        $this->visitorsCount = Visitor::where('last_activity', '>=', $last24Hours)->count();

        // Count online users (last 5 minutes)
        $this->onlineUsersCount = Visitor::where('last_activity', '>=', $last5Minutes)->count();
    }

    public function render()
    {
        return view('livewire.visitors-online');
    }
}
