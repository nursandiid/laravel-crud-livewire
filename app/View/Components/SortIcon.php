<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortIcon extends Component
{
    public $sortBy;
    public $sortDirection;
    public $field;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sortBy, $sortDirection, $field)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.sort-icon');
    }
}
