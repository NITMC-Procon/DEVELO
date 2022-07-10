<?php

namespace App\View\Components;

use Illuminate\View\Component;

class test extends Component
{
    public $name;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$id)
    {
        //
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.test');
    }
}
