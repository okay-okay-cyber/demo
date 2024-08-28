@extends('layouts.app')
@section('content')

@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color:red">{{$error}}</li>        
    @endforeach
</ul>
@endif

<body>
    <form action="{{route('auth.subscription.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">Exercise Form</h1>
        <form>
            <div class="mb-3">
                <label for="exerciseId" class="form-label">ID</label>
                <input type="text" name="id"class="form-control" id="exerciseId" placeholder="Enter Exercise Id">
            </div>
            <div class="mb-3">
                <label for="subscriptionStartDate" class="form-label">Subscription Start Date</label>
                <input type="date" name="subscription_start_date"class="form-control" id="subscriptionStartDate" placeholder="Enter Subscription Start Date">
            </div>
            <div class="mb-3">
                <label for="subscriptionRenewableDate" class="form-label">Subscription Renewable Date</label>
                <input type="date" name="subscription_renewable_date"class="form-control" id="subscriptionRenewableDate" placeholder="Enter Subscription Renewable Date">
            </div>
            <div class="mb-3">
                <label class="form-label">Action</label>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    </body>
@endsection    