@extends('layouts.app')
@section('content')
<div class="=col-lg-12 col-md-12">
    <h1>Workouts</h1>
    <h2>Workout Name: -{{ $workout->name }}</h2>
    <h3>Workout description: -{{ $workout->description }}</h3>
    <h4>Workout Exercise Name: -{{ $workout ->exercise }}</h4>
<div>
<img src="{{asset('storage/'.$workout->photo) }}" width="50" height="50"/>
</div>
</div>
@endsection  