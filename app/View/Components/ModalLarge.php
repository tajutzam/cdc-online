<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalLarge extends Component
{
    public $id;
    public $body;
    public $footer;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $body, $footer, $title)
    {
        //
        $this->id = $id;
        $this->body = $body;
        $this->footer = $footer;
        $this->title = $title;
    }
    public function render()
    {
        return view('components.modal-large');
    }
}
