<?php

namespace App\Http\Views\Composers;

use App\Helpers\Stage;
use Illuminate\View\View;

class StageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //$view->with('now', Carbon::now());
    }
}