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
        $motoristas = ListaMotoristas::where('id_motorista', $userId)->whereNull('deleted_at')->paginate(10);
        return view('livewire.motoristas', compact('motoristas'));
    }
}
