<?php

namespace App\Livewire\Budget;

use App\Models\Budget;
use Livewire\Component;
use App\Models\Category;
use App\Models\MonthlyBudget;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CreateBudget extends Component
{
    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    #[Validate('required|integer|min:1|max:12')]
    public $month;
    #[Validate('required|integer|min:1900|max:2100')]
    public $year;
    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|numeric|min:0')]
    public $amount;


    public function save()
    {
        $this->validate();

        MonthlyBudget::create([
            'family_id' => Auth::user()->family_id,
            'category_id' => $this->category_id,
            'month' => $this->month,
            'year' => $this->year,
            'amount' => $this->amount,
        ]);

        $this->reset(['month', 'year', 'category_id', 'amount']);
        $this->dispatch('budgetCreated');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $categories = Category::where('family_id', Auth::user()->family_id)
            ->where('type', 'EXPENSE')
            ->get();
        return view('livewire.budget.create-budget', [
            'categories' => $categories,
            'months' => $this->months,
        ]);
    }
}
