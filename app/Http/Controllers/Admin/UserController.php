<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $users = User::with('subscription')->get();
            return view('auth.user.index',compact('users'));
            //return view('user.index',compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscriptions = Subscription::all();
        return view('auth.user.form',compact('subscriptions'));
        //return view('user.form',compact('subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'role'=>'required',
            'name'=>'required',
            'email'=>'required',
            //'email_verified_at'=>'required',
            'password'=>'required',
            //'is_verified'=>'required',
            'phoneno'=>'required',
            'age'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'photo'=>'required|file|mimes:png,jpg,jpeg',
            'subscription_id'=>'required|numeric',
           ]);
           if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('users',$filename,'public');
           }
          User::create([
            'name'=>$request->name,
            'role'=>$request->role,
            'email'=>$request->email,
            'password'=>$request->password,
            'phoneno'=>$request->phoneno,
            'age'=>$request->age,
            'height'=>$request->height,
            'weight'=>$request->weight,
            'photo'=>$path,
            'subscription_id'=>$request->subscription_id,
            
          ]);
          return redirect('admin/user')->with('success','User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('subscription')->findOrFail($id);
        return view('auth.user.view',compact('user'));
        //return view('user.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscriptions = Subscription::all();
        $user = User::findOrFail($id);
        return view('auth.user.update',compact('subscriptions','user'));
       // return view('user.update',compact('subscriptions','user'));
    }

    /**
     * // <!--<td> {{ $user->subscription>subscription_renewable_date }} </td>-->
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate=$request->validate([
            'id'=>'required',
            'role'=>'required',
            'name'=>'required',
            'email'=>'required',
            //'email_verified_at'=>'required',
            'password'=>'required',
            //'is_verified'=>'required',
            'phoneno'=>'required',
            'age'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'photo'=>'required|file|mimes:png,jpg,jpeg',
            'subscription_id'=>'required|numeric',
           ]);
        $user = User::findOrFail($id);
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('users',$filename,'public');
            @unlink(storage_path().'/app/public/'.$user->photo);
            $validate['photo']=$path;
        }
       
        $user->update($validate);
        return redirect('admin/user')->with('success','User saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if(file_exists(storage_path().'/app/public/'.$user->photo)){
            @unlink(storage_path().'/app/public/'.$user->photo);
        }
        $user->delete();
        return redirect('admin/user')->with('success','User deleted successfully');
    }
}
