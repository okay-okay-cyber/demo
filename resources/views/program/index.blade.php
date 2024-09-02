@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Program</h1>
    <a href="{{ route ('program.create') }}">
        <button class="btn btn-info">Create Program</button>
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
        <th scope="col">duration_days</th>
        <th scope="col">photo</th>
        <th scope="col">exercise</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($programs as $program)
        <tr>
            <td>{{ $program->id }}</td>
            <td>{{ $program->name }}</td>
            <td>{{ $program->description }}</td>
            <td>{{ $program->duration_days }}</td>
           <td> <img src="{{ asset('storage/'.$program->photo) }}" alt="" width="50" height="50" /> </td>
           <td> {{ $program->exercise->name }} </td>
           <td>
            
            <!--<a href="{{ route('program.show',$program->id) }}">view</a>-->
           <!-- <a href="{{ route('program.edit',$program->id) }}">edit</a>-->

            <form action=" {{ route('program.show',$program->id) }}"method="GET">
              @method('VIEW')
              @csrf
              <button class="btn btn-info">View</button>
              
            </form>
            <form action=" {{ route('program.edit',$program->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button class="btn btn-warning">Edit</button>
              
            </form>
            <form action=" {{ route('program.destroy',$program->id) }}"method="POST">
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