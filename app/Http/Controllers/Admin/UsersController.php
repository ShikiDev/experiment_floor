<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_list = User::orderBy('created_at')->paginate(10);
        //
        return view('admin.users.user_list',[
            'user_list' => $users_list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|max:20|min:3',
            'email' => 'required|min:5|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->confirmed = ($request->input('confirmed_acc') != '')? 1 : 0 ;

        $user->save();

        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.user_edit',[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $password = $request->input('password','');
        if($password != ''){
            $this->validate(request(),[
                'name' => 'required|max:20|min:3',
                'email' => 'required|min:5|email',
                'password' => 'required|min:6|confirmed'
            ]);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->confirmed = ($request->input('confirmed_acc') != '')? 1 : 0 ;
        if($password != '') $user->password = Hash::make($password);
        $user->updated_at = date('Y-m-d H:i:s',time());
        $user->update();

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
