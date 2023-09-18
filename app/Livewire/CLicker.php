<?php

namespace App\Livewire;

use Livewire\Component;

class CLicker extends Component
{

    public $c = 0 ;

    public function render()
    {
        return view('livewire.c-licker');
    }
    public function incr()
    {
        $this->c++ ;
    }
    public function decr()
    {
        $this->c-- ;
    }

}

