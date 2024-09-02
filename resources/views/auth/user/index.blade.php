@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Workout</h1>
    <a href="{{ route ('user.create') }}">
        <button class="btn btn-info">Create user</button>
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
        <th scope="col">role</th>
        <th scope="col">photo</th>
        <th scope="col">email</th>
        <th scope="col">phoneno</th>
        <th scope="col">age</th> 
        <th scope="col">height</th>
        <th scope="col">weight</th>
        <th scope="col">subscription</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
           <td>{{ $user->role }}</td>
           <td> <img src="{{ asset('storage/'.$user->photo) }}" alt="" width="50" height="50" /> </td>
           <td>{{ $user->email }}</td>
           <td>{{ $user->phoneno}}</td>
           <td>{{ $user->age }}</td>
           <td>{{ $user->height }}</td>
           <td>{{ $user->weight }}</td>
           <td> {{ $user->renewable_date }} </td>
            

           <td>
            <form action=" {{ route('user.show',$user->id) }}"method="GET">
              @method('VIEW')
              @csrf
              <button  class="btn btn-info">View</button>
            
            </form>
          
            <form action=" {{ route('user.edit',$user->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button class="btn btn-warning">Edit</button>
              
            </form>

            <form action=" {{ route('user.destroy',$user->id) }}"method="POST">
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