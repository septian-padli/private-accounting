<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyBudget;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMonthlyBudgetRequest;
use App\Http\Requests\UpdateMonthlyBudgetRequest;

class MonthlyBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {

            $data = MonthlyBudget::where('family_id', $user->family_id)
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '-';
                })
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : '-';
                })
                ->addColumn('account', function ($row) {
                    return $row->account ? $row->account->name : '-';
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.monthly-budget.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMonthlyBudgetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MonthlyBudget $monthlyBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonthlyBudget $monthlyBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMonthlyBudgetRequest $request, MonthlyBudget $monthlyBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyBudget $monthlyBudget)
    {
        //
    }
}
