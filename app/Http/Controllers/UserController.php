<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $provinces = get_provinces();
        $degrees = get_degrees();
        return view('admin.users.profile', compact('provinces', 'degrees'));
    }

    public function create()
    {
        return view('admin.role.create_user');
    }

    public function createUser(Request $request)
    {
        $data = $this->validate($request, [
            'name'            => ['required', 'string', 'max:255'],
            'mobile'          => ['required', 'max:255', 'unique:users', 'regex:/(09)[0-9]{9}/', 'digits:11'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        User::create([
            'name'            => $data['name'],
            'mobile'          => $data['mobile'],
            'password'        => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.role.index');
    }
}
