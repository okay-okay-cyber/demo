@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Exercise</h1>
    <a href="{{ route ('auth.subscription.create') }}">
        <button>Add Subscription</button>
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
        <th scope="col">start_date</th>
        <th scope="col">renewable_date</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($subscriptions as $subscription)
        <tr>
            <td>{{ $subscription->id }}</td>
            <td>{{ $subscription->start_date }}</td>
            <td>{{ $subscription->renewable_date }}</td>
           
           <td>
            <form action=" {{ route('auth.subscription.show',$subscription->id) }}"method="GET">
              @method('VIEW')
              @csrf
              <button>View</button>
              
            </form>
            <form action=" {{ route('auth.subscription.edit',$subscription->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button>Edit</button>
              
            </form>
            <form action=" {{ route('auth.subscription.destroy',$subscription->id) }}"method="POST">
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