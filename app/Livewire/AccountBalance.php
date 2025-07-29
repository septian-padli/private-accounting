<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AccountBalance extends Component
{
    public $accounts;
    public $isDashboard = false;

    protected $listeners = ['transactionCreated' => 'refreshAccounts'];

    public function mount($isDashboard = false)
    {
        $this->isDashboard = $isDashboard;
        $this->refreshAccounts();
    }

    public function refreshAccounts()
    {
        $this->accounts = Account::where('family_id', Auth::user()->family_id)->get();
    }

    public function render()
    {
        return view('livewire.account-balance', [
            'isDashboard' => $this->isDashboard,
        ]);
    }
}
