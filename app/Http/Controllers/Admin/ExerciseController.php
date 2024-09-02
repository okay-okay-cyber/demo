<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::all(); // Retrieve all exercises
        return view('auth.exercise.index',compact('exercises'));
        //return view('exercise.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.exercise.form');
        //return view('exercise.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'photo'=>'required|file|mimes:png,jpg,jpeg',
           ]);

        
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('exercises',$filename,'public');

        }
       
        Exercise::create([
            'name'=>$request->name,
            'photo'=>$path
          ]);
        return redirect('admin/exercise')->with('success','Exercise saved successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('auth.exercise.index',compact('exercise'));
        
        //$exercise = Program::with('exercise')->findOrFail($id);
        //return view('exercise.view',compact('exercises'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('auth.exercise.update', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate( [
            'name' => 'required|string|max:255',
            'photo'=>'|file|mimes:png,jpg,jpeg',
        ]);

        $exercise = Exercise::findOrFail($id);

        if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('exercises',$filename,'public');
            @unlink(storage_path().'/app/public/'.$exercise->photo);
            $validate['exercise']=$path;
        }

        $exercise->update($validate);
        return redirect('admin/exercise')->with('success','Exercise saved successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exercise = Exercise::findOrFail($id);

        if ($exercise->photo) {
            Storage::disk('public')->delete($exercise->photo);
        }

        $exercise->delete();

        return redirect()->route('exercise.index')->with('success', 'Exercise deleted successfully!');
    
    }
}
