<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $title;
    public $links;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param array $links
     */
    public function __construct($title = 'Laravel App', $links = [])
    {
        $this->title = $title;
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
