<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $error;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($error, $name)
    {
        $this->name = $name;
        $this->error = $error;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
