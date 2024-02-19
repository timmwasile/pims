<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
     public $name;
    public $error;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $error)
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
        return view('components.form.textarea');
    }
}
