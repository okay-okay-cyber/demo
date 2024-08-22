
@extends('layouts.app')
@section('content')

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color:red">{{$error}}</li>        
    @endforeach
</ul>
@endif

<body>
    <form action="{{route('program.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">Program Form</h1>
        <form>
            <div class="mb-3">
                <label for="programName" class="form-label">Name</label>
                <input type="text" name="name"class="form-control" id="programName" placeholder="Enter program name">
            </div>
            <div class="mb-3">
                <label for="programDescription" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="programDescription" rows="3" placeholder="Enter program description"></textarea>
            </div>
            <div class="mb-3">
                <label for="duration_days" class="form-label">Duration Days</label>
                <input type="number" name="duration_days"class="form-control" id="duration_days" placeholder="Enter duration day">
            </div>
            <div class="mb-3">
                <label for="programPhoto" class="form-label">Photo</label>
                <input class="form-control"  name="photo" type="file" id="programPhoto">
            </div>
            <div class="mb-3">
                <label for="programExercise" class="form-label">Exercise</label>
                <select class="form-select" name="exercise_id" id="programExercise">
                    <option disabled>Choose a exercise</option>
                    @foreach($exercises as $exercise)
                    <option value="{{$exercise->id}}">{{$exercise->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Action</label>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    </body>
@endsection    