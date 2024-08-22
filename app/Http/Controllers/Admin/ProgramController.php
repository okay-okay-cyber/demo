<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('exercise')->get();
        return view('program.index',compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercises = Exercise::all();
        return view('program.form',compact('exercises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required',
        'description'=>'required',
        'duration_days'=>'required|numeric',
        'photo'=>'required|file|mimes:png,jpg,jpeg',
        'exercise_id'=>'required|numeric',
       ]);
       if($request->hasFile('photo')){
        $filename = $request->file('photo')->getClientOriginalName();
        $path= $request->file('photo')->storeAs('programs',$filename,'public');
       }
      Program::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'duration_days'=>$request->duration_days,
        'exercise_id'=>$request->exercise_id,
        'photo'=>$path
      ]);
      return redirect('admin/program')->with('success','Program added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = Program::with('exercise')->findOrFail($id);
        return view('program.view',compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exercises = Exercise::all();
        $program = Program::findOrFail($id);
        return view('program.update',compact('exercises','program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'duration_days'=>'required|numeric',
            'photo'=>'|file|mimes:png,jpg,jpeg',
            'exercise_id'=>'required|numeric',
           ]);
        $program = Program::findOrFail($id);
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->getClientOriginalName();
            $path= $request->file('photo')->storeAs('programs',$filename,'public');
            @unlink(storage_path().'/app/public/'.$program->photo);
            $validate['program']=$path;
        }
       
        $program->update($validate);
        return redirect('admin/program')->with('success','Program saved successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        if(file_exists(storage_path().'/app/public/'.$program->photo)){
            @unlink(storage_path().'/app/public/'.$program->photo);
        }
        $program->delete();
        return redirect('admin/program')->with('success','Program deleted successfully');
    }
}
