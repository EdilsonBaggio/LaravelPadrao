<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Motoristas as ListaMotoristas;
use Illuminate\Support\Facades\Auth;

class Motoristas extends Component
{
    public function render()
    {
        $userId = Auth::user()->id;
        $motoristas = ListaMotoristas::whereNull('deleted_at')->where('id_motorista', $userId)->paginate(5);
        return view('livewire.motoristas', ['motoristas' => $motoristas]);
    }
}
