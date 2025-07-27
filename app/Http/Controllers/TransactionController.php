<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cashout(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $typeTransaction = 'EXPENSE';
        if ($request->ajax()) {

            $data = Transaction::with(['category', 'account'])
                ->where('family_id', $user->family_id)
                ->whereHas('category', function ($q) use ($typeTransaction) {
                    $q->where('type', $typeTransaction);
                })
                ->orderBy('transaction_date', 'desc')
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

        return view('pages.transaction.cashout.index', compact('user', 'today', 'typeTransaction'));
    }

    public function cashin(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $typeTransaction = 'INCOME';
        if ($request->ajax()) {

            $data = Transaction::with(['category', 'account'])
                ->where('family_id', $user->family_id)
                ->whereHas('category', function ($q) use ($typeTransaction) {
                    $q->where('type', $typeTransaction);
                })
                ->orderBy('transaction_date', 'desc')
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

        return view('pages.transaction.cashin.index', compact('user', 'today', 'typeTransaction'));
    }
}
