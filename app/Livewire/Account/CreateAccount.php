<?php

namespace App\Livewire\Account;

use App\Models\Account;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateAccount extends Component
{
    use WithFileUploads;
    public $name, $balance, $number, $icon;

    protected $rules = [
        'name' => 'required|string|max:255',
        'number' => 'required|string|max:255',
        'balance' => 'numeric|nullable',
        'icon' => 'nullable|image|max:2048',
    ];

    public function save()
    {
        $user = Auth::user();
        $this->validate();

        if ($this->icon) {
            $slug = Str::slug($this->name);
            $extension = $this->icon->getClientOriginalExtension();
            $filename = "{$slug}-icon.{$extension}";
            $iconPath = $this->icon->storeAs('icons/account', $filename, 'public');
        } else {
            $iconPath = null;
        }

        DB::transaction(function () use ($user, $iconPath) {
            $account = Account::create([
                'family_id' => $user->family_id,
                'name' => $this->name,
                'number' => $this->number,
                'balance' => $this->balance ?? 0,
                'icon' => $iconPath
            ]);

            if ($this->balance > 0) {
                $categoryInitial = $user->family->categories()
                    ->whereRaw('LOWER(name) = ?', ['initial balance'])
                    ->first();
                Transaction::create([
                    'family_id' => $user->family_id,
                    'user_id' => $user->id,
                    'account_id' => $account->id,
                    'category_id' => $categoryInitial->id,
                    'note' => 'Initial balance',
                    'amount' => $this->balance,
                    'transaction_date' => now(),
                ]);
            }
        });

        $this->dispatch('accountCreated');
        $this->reset(['name', 'number', 'balance']);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.account.create-account');
    }
}
