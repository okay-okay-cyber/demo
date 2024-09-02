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
    <form action="{{route('subscription.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container mt-5">
        <h1 class="mb-4">Subscription Form</h1>
        <form>
            <div class="mb-3">
                <label for="subscriptionId" class="form-label">ID</label>
                <input type="text" name="id"class="form-control" id="subscriptionId" placeholder="Enter subscription Id">
            </div>
            <div class="mb-3">
                <label for="subscriptionStartDate" class="form-label">Subscription Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div class="mb-3">
                <label for="subscriptionRenewableDate" class="form-label">Subscription Renewable Date</label>
                <input type="date" name="renewable_date" value="{{ old('renewable_date') }}" required>
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