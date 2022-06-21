<?php

namespace App\Http\Controllers;

use App\User;
use App\Cashs;
use App\Costs;
use App\Saves;
use Illuminate\Http\Request;

class ExportController extends Controller
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
    public function all()
    {   
        $tot_cash = Cashs::sum('total');
        $tot_cost = Costs::sum('total');
        $tot_saves = Saves::sum('total');
        $tot_strike_cash = Cashs::max('total');
        $tot_strike_cost = Costs::max('total');
        $balance =  $tot_cash - $tot_cost;
        $tot_recap_cost = $balance - $tot_cost;

        return view('export.all', compact
        (
            'tot_cash', 'tot_cost', 'balance', 'tot_strike_cash', 'tot_strike_cost',
            'tot_recap_cost', 'tot_saves'
        ));
    }

    public function cash()
    {   
        $tot_cash = Cashs::sum('total');
        $cash_data = Cashs::all();

        return view('export.cash', compact
        (
            'tot_cash', 'cash_data'
        ));
    }

    public function cost()
    {   
        $tot_cost = Costs::sum('total');
        $cost_data = Costs::all();

        return view('export.cost', compact
        (
            'tot_cost', 'cost_data'
        ));
    }
}
