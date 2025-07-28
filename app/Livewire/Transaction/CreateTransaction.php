<?php

namespace App\Livewire\Transaction;

use App\Models\Account;
use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateTransaction extends Component
{
    #[Validate('required|date')]
    public $transaction_date;
    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|exists:accounts,id')]
    public $account_id;
    #[Validate('nullable|string|max:255')]
    public $note;
    #[Validate('required|numeric|min:5')]
    public $amount;
    public $today;
    public $typeTransaction;
    public $accountBalance = null;

    public function mount($today = null)
    {
        $this->today = $today ?? now()->format('Y-m-d');
        if (!$this->transaction_date) {
            $this->transaction_date = $this->today;
        }
    }

    public function updatedAccountId()
    {
        $this->accountBalance = Account::find($this->account_id)->balance;
        if ($this->accountBalance < $this->amount && $this->typeTransaction === 'EXPENSE') {
            // berikan error kepada amount
            $this->addError('amount', 'Saldo tidak cukup.');
        }
    }

    public function updatedAmount()
    {
        if ($this->amount > 0 && $this->accountBalance < $this->amount && $this->typeTransaction === 'EXPENSE') {
            $this->addError('amount', 'Saldo tidak cukup.');
        }
    }

    public function save()
    {
        $user = Auth::user();
        $this->validate();
        DB::transaction(function () use ($user) {
            Transaction::create([
                'family_id' => $user->family_id,
                'user_id' => $user->id,
                'account_id' => $this->account_id,
                'category_id' => $this->category_id,
                'note' => $this->note,
                'amount' => $this->amount,
                'transaction_date' => $this->transaction_date,
            ]);

            if ($this->typeTransaction === 'INCOME') {
                Account::where('id', $this->account_id)
                    ->increment('balance', $this->amount);
            } else {
                Account::where('id', $this->account_id)
                    ->decrement('balance', $this->amount);
            }
        });
        $this->dispatch('transactionCreated');
        $this->reset(['transaction_date', 'category_id', 'account_id', 'amount', 'note']);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $accounts = Account::where('family_id', Auth::user()->family_id)->get();
        $categories = Category::where('family_id', Auth::user()->family_id)
            ->where('type', $this->typeTransaction)
            ->whereRaw('LOWER(name) != ?', ['initial balance'])
            ->get();
        return view('livewire.transaction.create-transaction', compact('accounts', 'categories'));
    }
}
