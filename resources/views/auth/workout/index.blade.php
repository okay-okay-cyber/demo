@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Workout</h1>
    <a href="{{ route ('workout.create') }}">
        <button class="btn btn-info">Create workout</button>
    </a>
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{session::get('success')}}
    </div>
      
    @endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">photo</th>
        <th scope="col">exercise</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($workouts as $workout)
        <tr>
            <td>{{ $workout->id }}</td>
            <td>{{ $workout->name }}</td>
            <td>{{ $workout->description }}</td>
           <td> <img src="{{ asset('storage/'.$workout->photo) }}" alt="" width="50" height="50" /> </td>
           <td> {{ $workout->exercise->name }} </td>
           <td>
            

            <form action=" {{ route('workout.show',$workout->id) }}"method="GET">
              @method('VIEW')
              @csrf
              <button class="btn btn-info">View</button>
            
            </form>
          
            <form action=" {{ route('workout.edit',$workout->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button class="btn btn-warning">Edit</button>
              
            </form>

            <form action=" {{ route('workout.destroy',$workout->id) }}"method="POST">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger">Delete</button>
              
            </form>
           </td>
          </tr>  
        @empty
            <td>No data found</td>
        @endforelse
    

    </tbody>
  </table>
</div>
  @endsection