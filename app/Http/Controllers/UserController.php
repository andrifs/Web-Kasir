<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->paginate(5);
        return view('page.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|string|confirmed',
            'role' => 'required',
        ],
        [
           'name.required' => 'Nama tidak boleh kosong',
           'email.required' => 'Email tidak boleh kosong',
           'email.unique' => 'Email sudah digunakan',
           'password.required' => 'Password tidak boleh kosong',
           'password.min' => 'Minimal 8 karakter',
           'password.confirmed' => 'Password tidak sesuai',
           'role.required' => 'Role tidak boleh kosong',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        Alert::success('Berhasil!', 'Data user berhasil ditambahkan')->autoClose(3000);
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('page.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
        ],
        [
           'name.required' => 'Nama tidak boleh kosong',
           'role.required' => 'Role tidak boleh kosong',


        ]);

        $user = User::find($id);

        if($request->email != $user->email){
            $request->validate([
                'email' => 'required|unique:users,email'
            ],[
                'email.required' => 'Email tidak boleh kosong',
                'email.unique' => 'Email sudah digunakan',
            ]);
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->save();

        Alert::success('Berhasil!', 'Data user berhasil di edit')->autoClose(3000);
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Alert::success('Berhasil!', 'Data user berhasil di Hapus')->autoClose(3000);

        return redirect('user');
    }
}