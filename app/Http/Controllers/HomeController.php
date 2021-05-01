<?php

namespace App\Http\Controllers;

use App\Models\LeasingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $details = LeasingDetail::whereDate('date',date('Y-m-d'))->get();
        //dd($details);
        return view('main.dashboard',compact('details'));
    }
}
