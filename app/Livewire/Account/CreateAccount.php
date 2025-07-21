<?php

namespace App\Livewire\Account;

use App\Models\Account;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class CreateAccount extends Component
{
    public $name, $balance;

    protected $rules = [
        'name' => 'required|string|max:255',
        'balance' => 'required|numeric',
    ];

    public function save()
    {
        $user = Auth::user();
        $this->validate();
        Account::create([
            'family_id' => $user->family_id,
            'name' => $this->name,
            'balance' => $this->balance,
        ]);
        $this->dispatch('accountCreated');
        $this->reset(['name', 'balance']);
        $this->dispatch('close-modal');
        ToastMagic::success('Account created successfully!');
    }

    public function render()
    {
        return view('livewire.account.create-account');
    }
}
