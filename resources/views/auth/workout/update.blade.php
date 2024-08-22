

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
    <form action="{{route('workout.update',$workout->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">Workout Form</h1>
        <form>
            <div class="mb-3">
                <label for="workoutName" class="form-label">Name</label>
                <input type="text" name="name"class="form-control" id="workoutName" placeholder="Enter workout name" value="{{old('name',$workout->name)}}">
            </div>
            <div class="mb-3">
                <label for="workoutDescription" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="workoutDescription" rows="3" placeholder="Enter workout description">
                {{old('description',$workout->description)}}</textarea>
            </div>
            <div class="mb-3">
                <label for="workoutPhoto" class="form-label">Photo</label>
                <input class="form-control"  name="photo" type="file" id="workoutPhoto">
                @if(file_exists(storage_path().'/app/public/'. $workout->photo))
                <img src="{{asset('storage/'.$workout->photo)}}"width="50" height="50"/>
                @endif
            </div>
            <div class="mb-3">
                <label for="workoutExercise" class="form-label">Exercise</label>
                <select class="form-select" name="exercise_id" id="workoutExercise">
                    <option disabled>Choose a exercise</option>
                    @foreach($exercises as $exercise)
                    <option value="{{$exercise->id}}"{{$exercise->id==$workout->exercise_id?'selected':''}}>{{$exercise->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Action</label>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2" value="update">update</button>
                   
                </div>
            </div>
        </form>
    </div>
    </body>
@endsection  