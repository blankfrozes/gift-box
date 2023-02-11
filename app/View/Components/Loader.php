<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Loader extends Component
{
    public $width;

    public $height;

    public $thickness;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($size = 4, $thickness = 4)
    {
        $this->width = $size * 0.4;
        $this->height = $size * 0.4;
        $this->thickness = $thickness;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.loader');
    }
}
