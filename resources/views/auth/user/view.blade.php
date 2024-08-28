@extends('layouts.app')
@section('content')
<div class="=col-lg-12 col-md-12">
    <h1>Profile Picture</h1>
    <div>
        <img src="{{asset('storage/'.$user->photo) }}" width="50" height="50"/>
        </div>
    <h1>Users</h1>
    <h2>User Id: -{{ $user->id }}</h2>
    <h2>User Name: -{{ $user->name }}</h2>
    <h2>User Role: -{{ $user->role }}</h2>
    <h2>User Email: -{{ $user->email }}</h2>
    <h2>User Phoneno: -{{ $user->phoneno}}</h2>
    <h2>User Age: -{{ $user->age}}</h2>
    <h2>User Height: -{{ $user->height }}</h2>
    <h2>User Weight: -{{ $user->weight }}</h2>
    <h4>User Subscription Renewable Date: -{{ $user ->subscription }}</h4>
</div>
@endsection  