<?php

namespace App\View\Components\Frontend\Layouts;

use Illuminate\View\Component;

class FrontendLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.layouts.frontend-layout');
    }
}
