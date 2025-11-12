<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Render the layout view.
     */
    public function render(): View
    {
        // Gunakan layout yang benar
        return view('layouts.app');
    }
}
