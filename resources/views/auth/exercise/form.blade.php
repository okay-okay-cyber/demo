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
    <form action="{{route('exercise.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">Exercise Form</h1>
        <form>
            <div class="mb-3">
                <label for="exerciseId" class="form-label">ID</label>
                <input type="text" name="id"class="form-control" id="exerciseId" placeholder="Enter Exercise Id">
            </div>
            <div class="mb-3">
                <label for="exerciseName" class="form-label">Name</label>
                <input type="text" name="name"class="form-control" id="exerciseName" placeholder="Enter Exercise name">
            </div>
            <div class="mb-3">
                <label for="exercisePhoto" class="form-label">Photo</label>
                <input class="form-control"  name="photo" type="file" id="exercisePhoto">
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