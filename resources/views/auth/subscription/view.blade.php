@extends('layouts.app')
@section('content')
<div class="=col-lg-12 col-md-12">
    
    <h1>Subscriptions</h1>
    <h2>Subscription Id</h2>
    <h3>Subscription Start Date: -{{ $subscription->start_date }}</h3>
    <h3>Subscription Renewable Date: -{{ $subscription->renewable_date }}</h3>
<div>
<img src="{{asset('storage/'.$exercise->photo) }}" width="50" height="50"/>
</div>
</div>
@endsection  
 