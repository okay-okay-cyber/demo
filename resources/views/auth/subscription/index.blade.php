@extends('layouts.app')

@section('content')
<div class="col-lg-12 col-md-12">
    <h1>Exercise</h1>
    <a href="{{ route ('subscription.create') }}">
        <button class="btn btn-info">Add Subscription</button>
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
            <td>
              <input type="date" value="{{ \Carbon\Carbon::parse($subscription->start_date)->format('Y-m-d') }}" readonly />
          </td>
          <td>
              <input type="date" value="{{ \Carbon\Carbon::parse($subscription->renewable_date)->format('Y-m-d') }}" readonly />
          </td>
           
           <td>
            
            <form action=" {{ route('subscription.edit',$subscription->id) }}"method="GET">
              @method('EDIT')
              @csrf
              <button class="btn btn-warning">Edit</button>
              
            </form>
            <form action=" {{ route('subscription.destroy',$subscription->id) }}"method="POST">
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