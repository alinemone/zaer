<?php

namespace App\Http\Controllers;

use App\Models\AllocatedBed;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client')->except('getCities');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $receptions = AllocatedBed::with([
            'place',
            'room',
            'bed',
            'people'
        ])
            ->whereDate(AllocatedBed::EXPIRED_AT,'<=' ,now()->toDateString())
            ->orderByDesc('id')
            ->paginate();

        return view('admin.index', compact('receptions'));
    }

    public function getCities($id)
    {
        return get_cities($id);
    }
}
