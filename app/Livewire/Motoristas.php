<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Motoristas as ListaMotoristas;

class Motoristas extends Component
{
    public function render()
    {
        $motoristas = ListaMotoristas::whereNull('deleted_at')->paginate(5);
        return view('livewire.motoristas', ['motoristas' => $motoristas]);
    }
}
