<?php

namespace App\Http\Controllers;

use App\Models\HariKerja;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $user = User::get()->count();
        $hariKerja = HariKerja::get()->count();
        $shift = Shift::get()->count();
        return view('admin.index', compact('user', 'hariKerja', 'shift'));
    }
}
