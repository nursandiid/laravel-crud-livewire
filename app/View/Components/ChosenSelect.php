<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChosenSelect extends Component
{
    public $multiple;
    public $model;
    public $placeholder;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($multiple = false, $model, $placeholder = false, $class = null)
    {
        $this->multiple = $multiple;
        $this->model = $model;
        $this->placeholder = $placeholder;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.chosen-select');
    }
}
