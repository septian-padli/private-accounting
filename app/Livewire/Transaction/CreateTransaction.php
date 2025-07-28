<?php

namespace App\Livewire\Transaction;

use App\Models\Account;
use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateTransaction extends Component
{
    public $transaction_date, $category_id, $account_id, $amount, $note, $today, $typeTransaction;

    protected $rules = [
        'transaction_date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'account_id' => 'required|exists:accounts,id',
        'amount' => 'required|numeric',
        'note' => 'nullable|string|max:255',
    ];

    public function mount($today = null)
    {
        $this->today = $today ?? now()->format('Y-m-d');
        if (!$this->transaction_date) {
            $this->transaction_date = $this->today;
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
            Account::where('id', $this->account_id)
                ->increment('balance', $this->amount);
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
