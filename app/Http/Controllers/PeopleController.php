<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use App\Http\Requests\People\PeopleRegisterRequest;

class PeopleController extends Controller
{

    /**
     * @param $nationalCode
     * @return mixed
     */
    public function findByNationalCode($nationalCode)
    {
        $people = People::where(People::NATIONAL_CODE, $nationalCode)
            ->with('latestAllocatedBed')
            ->firstOrfail();

        $people->receptiveInLastMonthAgo = (bool)$people->latestAllocatedBed;

        return $people;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = get_provinces();
        $degrees = get_degrees();

        return view('people.register', compact('provinces', 'degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleRegisterRequest $request)
    {
        People::create([
            'name_family'   => $request->name_family,
            'national_code' => $request->national_code,
            'mobile'        => $request->mobile,
            'birthday'      => $request->birthday,
            'gender'        => $request->gender,
            'country'       => $request->country,
            'province'      => $request->city,
            'city'          => $request->town,
            'degree'        => $request->degree,
            'job'           => $request->job,
            'how_to'        => $request->how_to,
        ]);

        alert()->success('پیش ثبت نام شما با موفقیت انجام شد');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
