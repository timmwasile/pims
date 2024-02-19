<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $error;
    public $object;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($error, $name, $object)
    {
        $this->name = $name;
        $this->error = $error;
        $this->object = $object;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
