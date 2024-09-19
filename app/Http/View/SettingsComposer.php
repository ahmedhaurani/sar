<?php

// app/Http/View/Composers/SettingsComposer.php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Setting;

class SettingsComposer
{
    public function compose(View $view)
    {
        $settings = Setting::first();
        $view->with('settings', $settings);
    }
}
