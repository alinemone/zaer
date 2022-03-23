<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Imports\PeopleImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $provinces = get_provinces();

        $qroupMemeber = GroupMember::where(GroupMember::GROUP_ID, $id)->with('people.allocatedBed')->get();
//        dd($qroupMemeber->toArray());
        return view('admin.group_member.index', compact(['provinces', 'qroupMemeber']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = Storage::disk('local')->put('/files', $request->file('exel'));

        Excel::import(new PeopleImport, storage_path('app/' . $file));

        File::delete(storage_path('app/' . $file));

        return back();
    }
}
