<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all(); // Retrieve all exercises
        return view('auth.subscription.index',compact('subscriptions'));
       // return view('auth.exercise.index',compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.subscription.form');
        //return view('auth.exercise.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //  $request->validate([
      $request->validate([
            'id'=>'required',
            'start_date'=>'required|date',
            'renewable_date'=>'required|date',
           ]);
       
        Subscription::create([
            'id'=>$request->name,
            'start_date'=>$request->start_date,
            'renewable_date'=>$request->renewable_date,
           
          ]);
        return redirect('admin/subscription')->with('success','Subscription saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('auth.subscription.index',compact('subscriptions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('auth.subscription.update', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate( [
            'id'=>'required',
            'start_date'=>'required|date',
            'renewable_date'=>'required|date',
        ]);

        $subscription = Subscription::findOrFail($id);

        $subscription->update($validate);
        return redirect('admin/subscription')->with('success','Subscription saved successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();
        return redirect()->route('subscription.index')->with('success', 'subscription deleted successfully!');
        
    }
}
