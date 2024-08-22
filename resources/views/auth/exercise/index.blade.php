@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Exercise</h1>
    <a href="{{ route ('exercise.create') }}">
        <button>Create Exercise</button>
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
        <th scope="col">photo</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($exercises as $exercise)
        <tr>
            <td>{{ $exercise->id }}</td>
            <td>{{ $exercise->name }}</td>
           <td> <img src="{{ asset('storage/'.$exercise->photo) }}" alt="" width="50" height="50" /> </td>
           
           <td>
            <form action=" {{ route('exercise.show',$exercise->id) }}"method="GET">
              @method('VIEW')
              @csrf
              <button>View</button>
              
            </form>
            <form action=" {{ route('exercise.edit',$exercise->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button>Edit</button>
              
            </form>
            <form action=" {{ route('exercise.destroy',$exercise->id) }}"method="POST">
              @method('DELETE')
              @csrf
              <button>Delete</button>
              
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