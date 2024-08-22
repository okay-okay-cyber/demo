@extends('layouts.app')
@section('content')
<div class="=col-lg-12 col-md-12">
    <h1>Programs</h1>
    <h2>Program Name: -{{ $program->name }}</h2>
    <h3>Product description: -{{ $program->description }}</h3>
    <h4>Program Exercise Name: -{{ $program ->exercise }}</h4>
<div>
<img src="{{asset('storage/'.$program->photo) }}" width="50" height="50"/>
</div>
</div>
@endsection  