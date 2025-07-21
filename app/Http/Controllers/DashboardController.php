<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class DashboardController extends Controller
{
    public function pendingFamily()
    {
        $user = Auth::user();
        if ($user->family_id) {
            return redirect()->route('dashboard');
        }
        return view('pages.starterPage.pendingFamily');
    }

    public function index()
    {
        return view('pages.dashboard');
    }
}
