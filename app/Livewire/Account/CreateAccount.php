<?php

namespace App\Livewire\Account;

use App\Models\Account;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class CreateAccount extends Component
{
    public $name, $balance, $number;

    protected $rules = [
        'name' => 'required|string|max:255',
        'number' => 'required|string|unique:accounts,number',
        'balance' => 'required|numeric',
    ];

    public function save()
    {
        $user = Auth::user();
        $this->validate();
        Account::create([
            'family_id' => $user->family_id,
            'name' => $this->name,
            'number' => $this->number,
            'balance' => $this->balance,
        ]);
        $this->dispatch('accountCreated');
        $this->reset(['name', 'number', 'balance']);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.account.create-account');
    }
}
