<?php

namespace App\Livewire\Budget;

use Livewire\Component;
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
    public $selectedMonth;
    public $selectedYear;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $budgets = $this->user->family->monthlyBudgets()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

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
        $this->monthlyBudgets = array_values($grouped);

        return view('livewire.budget.read-budget', [
            'months' => $this->months,
            'monthlyBudgets' => $this->monthlyBudgets,
        ]);
    }
}
