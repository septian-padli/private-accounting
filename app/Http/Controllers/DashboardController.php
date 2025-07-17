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

    public function startFamily()
    {
        $user = Auth::user();
        if ($user->family_id) {
            return redirect()->route('dashboard');
        }
        return view('pages.starterPage.createFamily');
    }

    public function createFamily(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        DB::transaction(function () use ($validated, $user) {
            // Buat family baru
            $family = Family::create([
                'name' => $validated['name'],
            ]);

            $user->family_id = $family->id;
            $user->status = 'OWNER';
            $user->save();
        });

        ToastMagic::success('Family created successfully!');
        return redirect()->route('dashboard');
    }

    public function index()
    {
        return view('pages.dashboard');
    }
}
