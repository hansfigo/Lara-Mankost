<?php

namespace App\Http\Controllers;

use App\User;
use App\Cashs;
use App\Costs;
use App\Saves;
use App\Reports;
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
        $tot_cash = Cashs::sum('total');
        $tot_cost = Costs::sum('total');
        $tot_saves = Saves::sum('total');
        $tot_strike_cash = Cashs::max('total');
        $tot_strike_cost = Costs::max('total');
        $balance =  $tot_cash - $tot_cost;
        $tot_recap_cost = $balance - $tot_cost;

        $show = Reports::latest()->paginate(1)->appends(request()->except('page'));
        $hasData = Reports::first();
        $tot_cash_today = Cashs::whereDate('created_at', Carbon::today())->sum('total');
        $tot_cost_today = Costs::whereDate('created_at', Carbon::today())->sum('total');
        /*

        Don't let your balance and savings exceed your daily expenses or total expenses
        Calculate your expenses

        */

        // CHART PIE GRAPH

        $get_totals_pie = $tot_cash + $tot_cost + $tot_saves;
        // END PIE GRAPH

        return view('home', compact
        (
            'tot_cash', 'tot_cost', 'balance', 'tot_strike_cash', 'tot_strike_cost',
            'tot_recap_cost', 'tot_saves', 'show', 'hasData', 'tot_cash_today',
            'tot_cost_today', 'get_totals_pie'
        )
      );
    }

    public function massdelete()
    {
        $delete = Cashs::truncate();
        $delete = Costs::truncate();
        $delete = Saves::truncate();
        $delete = Reports::truncate();

        return redirect()->back()->with(['success.down' => 'All deleted!']);
    }
}
