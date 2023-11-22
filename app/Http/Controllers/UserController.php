<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Input;
use Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // Log::info(asset('storage/uploads/1700630092.jpg'));
        $users = User::all(['id','first_name','last_name','email','password','dob','gender','phone','profile_pic']);
        return response()->json($users);
    }
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Log::info($request->file());

        // $fileName = time().'.'.$request->file->extension();
        $fileName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('uploads'), $fileName);


        $users = User::create(['first_name' => $request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'password'=>bcrypt($request->password),'dob'=>$request->dob,'gender'=>$request->gender,'phone'=>$request->phone,'profile_pic'=>$fileName]);

        return response()->json($users);

    }
    public function show(User $user)
    {
        return response()->json($user);
    }


    public function update(Request $request, User $user)
    {
        $user->fill($request->post())->save();

        return response()->json([
            'message'=>'Users Updated Successfully!!',
            'user'=>$user
        ]);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message'=>'User Deleted Successfully!!'
        ]);
    }


}
