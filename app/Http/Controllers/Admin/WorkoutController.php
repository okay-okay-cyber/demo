<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::with('exercise')->get();
        return view('auth.workout.index',compact('workouts'));
       // return view('workout.index',compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercises = Exercise::all();
        return view('auth.workout.form',compact('exercises'));
        //return view('workout.form',compact('exercises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'photo'=>'required|file|mimes:png,jpg,jpeg',
            'exercise_id'=>'required|numeric',
           ]);
           if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('workouts',$filename,'public');
           }
          Workout::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'exercise_id'=>$request->exercise_id,
            'photo'=>$path
          ]);
          return redirect('admin/workout')->with('success','Workout added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workout = Workout::with('exercise')->findOrFail($id);
        return view('auth.workout.view',compact('workout'));
        //return view('program.view',compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exercises = Exercise::all();
        $workout = Workout::findOrFail($id);
        return view('auth.workout.update',compact('exercises','workout'));
       // return view('program.update',compact('exercises','program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    
       $validate=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'photo'=>'|file|mimes:png,jpg,jpeg',
            'exercise_id'=>'required|numeric',
           ]);
        $workout = Workout::findOrFail($id);
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('workouts',$filename,'public');
            @unlink(storage_path().'/app/public/'.$workout->photo);
            $validate['workout']=$path;
        }
       
        $workout->update($validate);
        return redirect('admin/workout')->with('success','Workout saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workout = Workout::findOrFail($id);
        if(file_exists(storage_path().'/app/public/'.$workout->photo)){
            @unlink(storage_path().'/app/public/'.$workout->photo);
        }
        $workout->delete();
        return redirect('admin/workout')->with('success','Workout deleted successfully');
    }
}
