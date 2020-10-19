<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $project;

    public function render()
    {
        return view('livewire.card');
    }
}
