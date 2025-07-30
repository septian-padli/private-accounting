<?php

namespace App\Livewire\Budget;

use Livewire\Component;
use App\Models\Category;
use App\Models\MonthlyBudget;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class ReadBudget extends Component
{
    public $user;
    public $monthlyBudgets;
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
    public $filterMonth;
    public $filterYear;
    public $categories;

    public $budgetId;

    #[Validate('required|integer|min:1|max:12')]
    public $month;
    #[Validate('required|integer|min:1900|max:2100')]
    public $year;
    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|numeric|min:0')]
    public $amount;

    protected $listeners = ['budgetCreated' => 'refreshBudgets'];

    public function mount($budgetId = null)
    {
        $this->user = Auth::user();
    }

    public function refreshBudgets() {}

    public function openEditModal($budgetId)
    {
        $this->budgetId = $budgetId;
        $budget = MonthlyBudget::findOrFail($budgetId);
        $this->month = $budget->month;
        $this->year = $budget->year;
        $this->category_id = $budget->category_id;
        $this->amount = $budget->amount;
        $this->dispatch('show-edit-modal');
    }

    public function update()
    {
        $this->validate();

        MonthlyBudget::where('id', $this->budgetId)->update([
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

    protected function groupingBudget($budgets)
    {
        // Index budgets by category, year, month for fast lookup
        $budgetIndex = [];
        foreach ($budgets as $b) {
            $budgetIndex[$b->category_id][$b->year][$b->month] = $b;
        }

        $grouped = [];
        foreach ($budgets as $budget) {
            // Cari budget bulan sebelumnya pada kategori yang sama
            $prevMonth = $budget->month - 1;
            $prevYear = $budget->year;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear -= 1;
            }
            $prevBudget = $budgetIndex[$budget->category_id][$prevYear][$prevMonth] ?? null;
            $prevAmount = $prevBudget ? $prevBudget->amount : null;

            // Hitung persentase perubahan
            if ($prevAmount && $prevAmount != 0) {
                $budget->percentage_change = round((($budget->amount - $prevAmount) / $prevAmount) * 100, 2);
            } else {
                $budget->percentage_change = null;
            }

            $key = $budget->month . '-' . $budget->year;
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'month' => $budget->month,
                    'year' => $budget->year,
                    'data' => [],
                ];
            }
            $grouped[$key]['data'][] = $budget;
        }

        // Sorting: urutkan berdasarkan year desc, month desc
        usort($grouped, function ($a, $b) {
            if ($a['year'] === $b['year']) {
                return $b['month'] <=> $a['month'];
            }
            return $b['year'] <=> $a['year'];
        });

        return array_values($grouped);
    }

    public function render()
    {
        $budgets = $this->user->family->monthlyBudgets()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $this->monthlyBudgets = $this->groupingBudget($budgets);

        $query = Category::where('family_id', Auth::user()->family_id)
            ->where('type', 'EXPENSE')->get();


        $this->categories = $query;
        return view('livewire.budget.read-budget', [
            'months' => $this->months,
            'monthlyBudgets' => $this->monthlyBudgets,
            'budgetId' => $this->budgetId,
        ]);
    }
}
