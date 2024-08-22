@extends('layouts.app')
@section('content')
<div class="=col-lg-12 col-md-12">
    
    <h1>Exercises</h1>
    <h2>Exercise Id</h2>
    <h3>Exercise Name: -{{ $exercise->name }}</h3>
<div>
<img src="{{asset('storage/'.$exercise->photo) }}" width="50" height="50"/>
</div>
</div>
@endsection  
 