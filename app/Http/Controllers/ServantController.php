<?php

namespace App\Http\Controllers;

use App\Http\Requests\Servant\ServantCreateRequest;
use App\Models\AllocatedBed;
use App\Models\People;
use App\Models\Servant;
use Illuminate\Http\Request;

class ServantController extends Controller
{
    /**
     * @param $nationalCode
     * @return mixed
     */
    public function findByNationalCode($nationalCode)
    {
        $servant = Servant::where(Servant::NATIONAL_CODE, $nationalCode)
            ->with('latestAllocatedBed')
            ->firstOrfail();

        $servant->receptiveInLastMonthAgo = (bool)$servant->latestAllocatedBed->first();

        return $servant;
    }

    public function list()
    {
        $servants = Servant::orderByDesc('id')->paginate(15);

        return view('admin.servant.list', compact('servants'));
    }

    public function create()
    {
        $provinces = get_provinces();
        $degrees = get_degrees();

        return view('admin.servant.create', compact('provinces', 'degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Servant\ServantCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ServantCreateRequest $request)
    {
        Servant::create([
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
            'phone'         => $request->phone,
            'workplace'     => $request->workplace,
            'quota'         => $request->quota,
            'start_at'      => jalali_to_carbon($request->start_at),
            'expired_at'    => jalali_to_carbon($request->expired_at)
        ]);

        alert()->success(' ثبت نام خادم با موفقیت انجام شد');

        return redirect()->route('admin.servant.list');
    }

    public function edit($id)
    {
        $servant = Servant::where('id', $id)->first();
        $provinces = get_provinces();
        $degrees = get_degrees();

        return view('admin.servant.edit',compact('servant','provinces','degrees'));
    }

    public function update(Request $request)
    {

        Servant::where('id',$request->id)->update([
            'name_family'   => $request->name_family,
            'national_code' => $request->national_code,
            'mobile'        => $request->mobile,
            'birthday'      => jalali_to_carbon($request->birthday),
            'gender'        => $request->gender,
            'country'       => $request->country,
            'province'      => $request->province,
            'city'          => $request->city,
            'degree'        => $request->degree,
            'job'           => $request->job,
            'how_to'        => $request->how_to,
            'phone'         => $request->phone,
            'workplace'     => $request->workplace,
            'quota'         => $request->quota,
            'start_at'      => jalali_to_carbon($request->start_at),
            'expired_at'    => jalali_to_carbon($request->expired_at)
        ]);

        return redirect()->route('admin.servant.list');

    }

    public function delete(Request $request)
    {

    }

    public function reception(Request $request)
    {

    }
}
