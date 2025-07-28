<?php

namespace App\Livewire\Transaction;

use App\Models\Account;
use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InternalTransfer extends Component
{
    #[Validate('required|date')]
    public $transaction_date;
    #[Validate('required|exists:accounts,id')]
    public $source_account_id;
    #[Validate('required|exists:accounts,id')]
    public $destination_account_id;
    #[Validate('nullable|string|max:255')]
    public $note;
    #[Validate('required|numeric|min:5')]
    public $amount;
    public $today, $sourceAccountBalance = null, $categoryInternal, $accounts;

    public function mount($today = null)
    {
        $this->today = $today ?? now()->format('Y-m-d');
        if (!$this->transaction_date) {
            $this->transaction_date = $this->today;
        }
    }

    public function updatedSourceAccountId()
    {
        $this->sourceAccountBalance = Account::find($this->source_account_id)->balance;
        if ($this->sourceAccountBalance < $this->amount) {
            // berikan error kepada amount
            $this->addError('amount', 'Saldo tidak cukup.');
        }

        $this->accounts = Account::where('family_id', Auth::user()->family_id)
            ->where('id', '!=', $this->source_account_id)->get();
    }

    public function updatedAmount()
    {
        if ($this->amount > 0 && $this->sourceAccountBalance < $this->amount) {
            $this->addError('amount', 'Saldo tidak cukup.');
        }
    }


    public function save()
    {
        $user = Auth::user();
        $this->validate();
        $this->categoryInternal = Category::where('name', 'Internal Transfer')->first();
        DB::transaction(function () use ($user) {
            Transaction::create([
                'family_id' => $user->family_id,
                'user_id' => $user->id,
                'account_id' => $this->source_account_id,
                'category_id' => $this->categoryInternal->id,
                'transaction_date' => $this->transaction_date,
                'amount' => $this->amount,
                'note' => $this->note,
                'type' => 'EXPENSE',
            ]);

            Transaction::create([
                'family_id' => $user->family_id,
                'user_id' => $user->id,
                'account_id' => $this->destination_account_id,
                'category_id' => $this->categoryInternal->id,
                'transaction_date' => $this->transaction_date,
                'amount' => $this->amount,
                'note' => $this->note,
                'type' => 'INCOME',
            ]);

            Account::where('id', $this->source_account_id)
                ->decrement('balance', $this->amount);

            Account::where('id', $this->destination_account_id)
                ->increment('balance', $this->amount);
        });

        $this->dispatch('transactionCreated');
        $this->reset(['transaction_date', 'source_account_id', 'destination_account_id', 'amount', 'note']);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $this->accounts = Account::where('family_id', Auth::user()->family_id)->get();
        return view('livewire.transaction.internal-transfer', ['accounts' => $this->accounts]);
    }
}
